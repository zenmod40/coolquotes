<?php
/**
 * CoolQuotes - Une citation qui se déplie au clic, pour PrestaShop
 *
 * @author    ZM40 — Nicolas Michaud (Magic Garden)
 * @copyright 2026 Nicolas Michaud — ZM40 / Magic Garden
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License version 3.0
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 */
/**
 * Le marchand gère ses citations depuis le back-office, les cible par
 * catégorie, choisit le coin et les pages où elles apparaissent. Livré avec
 * une bibliothèque de citations du domaine public.
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

require_once dirname(__FILE__) . '/classes/CoolQuote.php';
require_once dirname(__FILE__) . '/lib/zm40/Zm40CommonCq.php';

class CoolQuotes extends Module
{
    /** Contrôleurs où l'on n'interrompt jamais : le tunnel d'achat. */
    const CHECKOUT_CONTROLLERS = ['order', 'cart', 'orderconfirmation', 'authentication', 'registration'];

    public function __construct()
    {
        $this->name = 'coolquotes';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'ZM40';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '1.7.0.0', 'max' => '9.99.99'];
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('CoolQuotes');
        $this->description = $this->l('Affiche une citation dans un coin de vos pages, dépliée au clic. Ciblage par catégorie, bibliothèque de citations du domaine public fournie.');
        // Le message doit dire ce qui va réellement se passer, pas poser une
        // question dont la réponse est déjà tranchée en configuration.
        $this->confirmUninstall = Configuration::get('COOLQUOTES_KEEP_DATA')
            ? $this->l('Vos citations restent en base : vous les retrouverez en réinstallant le module.')
            : $this->l('Vos citations seront définitivement supprimées. Continuer ?');
    }

    /* ── Cycle de vie ─────────────────────────────────────────────── */

    public function install()
    {
        return parent::install()
            && $this->installSql()
            && $this->installTab()
            && $this->seedQuotes()
            && $this->installDefaults()
            && $this->registerHook('displayBeforeBodyClosingTag')
            && $this->registerHook('actionFrontControllerSetMedia');
    }

    public function uninstall()
    {
        $this->uninstallTab();
        if (!Configuration::get('COOLQUOTES_KEEP_DATA')) {
            Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'coolquote_lang`');
            Db::getInstance()->execute('DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'coolquote`');
        }
        $zm40 = ['ZM40_NET_ENABLED', 'ZM40_FEED_CACHE', 'ZM40_FEED_CACHE_TS',
            'ZM40_LASTCHECK_COOLQUOTES', 'ZM40_LATEST_COOLQUOTES'];
        foreach (array_merge($this->configKeys(), $zm40) as $k) {
            Configuration::deleteByName($k);
        }

        return parent::uninstall();
    }

    private function configKeys()
    {
        return [
            'COOLQUOTES_ACTIVE', 'COOLQUOTES_POSITION', 'COOLQUOTES_LABEL',
            'COOLQUOTES_KIND', 'COOLQUOTES_COUNT',
            'COOLQUOTES_SOUND', 'COOLQUOTES_MUSIC', 'COOLQUOTES_VOLUME', 'COOLQUOTES_DELAY',
            'COOLQUOTES_HIDE_CHECKOUT', 'COOLQUOTES_AUTO_OPEN', 'COOLQUOTES_KEEP_DATA',
        ];
    }

    private function installDefaults()
    {
        return Configuration::updateValue('COOLQUOTES_ACTIVE', 1)
            && Configuration::updateValue('COOLQUOTES_POSITION', 'bottom-left')
            && Configuration::updateValue('COOLQUOTES_LABEL', 'Tirer une citation')
            && Configuration::updateValue('COOLQUOTES_KIND', 'Une pensée')
            && Configuration::updateValue('COOLQUOTES_COUNT', 8)
            // Le son est une intrusion : le marchand doit le demander.
            && Configuration::updateValue('COOLQUOTES_SOUND', 0)
            && Configuration::updateValue('COOLQUOTES_MUSIC', 0)
            && Configuration::updateValue('COOLQUOTES_VOLUME', 35)
            && Configuration::updateValue('COOLQUOTES_DELAY', 90)
            && Configuration::updateValue('COOLQUOTES_HIDE_CHECKOUT', 1)
            && Configuration::updateValue('COOLQUOTES_AUTO_OPEN', 0)
            && Configuration::updateValue('COOLQUOTES_KEEP_DATA', 1)
            && Configuration::updateValue('ZM40_NET_ENABLED', 1);
    }

    private function installSql()
    {
        foreach (require dirname(__FILE__) . '/sql/install.php' as $query) {
            if (!Db::getInstance()->execute($query)) {
                return false;
            }
        }

        return $this->ensureColumns();
    }

    /**
     * Les tables sont créées en IF NOT EXISTS : sur une boutique où le module
     * a déjà tourné et où les citations ont été conservées, une colonne
     * ajoutée depuis n'arriverait jamais. On la rattrape ici.
     *
     * information_schema plutôt que SHOW COLUMNS : Db::getValue() ajoute un
     * LIMIT 1 que SHOW n'accepte pas.
     */
    private function ensureColumns()
    {
        $table = _DB_PREFIX_ . 'coolquote';
        $rows = Db::getInstance()->executeS(
            'SELECT COLUMN_NAME FROM information_schema.COLUMNS
             WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = \'' . pSQL($table) . '\''
        );
        $existing = array_map(function ($r) {
            return Tools::strtolower($r['COLUMN_NAME']);
        }, (array) $rows);

        foreach (['theme' => 'VARCHAR(32)', 'kind' => 'VARCHAR(32)'] as $column => $type) {
            if (!in_array($column, $existing, true)) {
                Db::getInstance()->execute(
                    'ALTER TABLE `' . $table . '` ADD COLUMN `' . $column . '` '
                    . $type . ' NOT NULL DEFAULT \'\''
                );
            }
        }

        return true;
    }

    /** Bibliothèque livrée avec le module (chargée une seule fois). */
    private function seedQuotes()
    {
        if ((int) Db::getInstance()->getValue('SELECT COUNT(*) FROM `' . _DB_PREFIX_ . 'coolquote`')) {
            return true;
        }
        $langs = Language::getLanguages(false);
        $pos = 1;
        foreach (require dirname(__FILE__) . '/data/quotes.php' as [$theme, $kind, $text, $author]) {
            $q = new CoolQuote();
            $q->theme = $theme;
            $q->kind = $kind;
            $q->categories = '';
            $q->active = 1;
            $q->position = $pos++;
            foreach ($langs as $l) {
                $q->text[(int) $l['id_lang']] = $text;
                $q->author[(int) $l['id_lang']] = $author;
            }
            $q->add();
        }

        return true;
    }

    private function installTab()
    {
        $tab = new Tab();
        $tab->class_name = 'AdminCoolQuotes';
        $tab->module = $this->name;
        $tab->id_parent = -1; // onglet masqué : on entre par « Configurer »
        $tab->active = true;
        foreach (Language::getLanguages(false) as $l) {
            $tab->name[(int) $l['id_lang']] = 'CoolQuotes';
        }

        return $tab->add();
    }

    private function uninstallTab()
    {
        $id = (int) Tab::getIdFromClassName('AdminCoolQuotes');
        if ($id) {
            (new Tab($id))->delete();
        }

        return true;
    }

    /* ── Configuration ────────────────────────────────────────────── */

    public function getContent()
    {
        $out = '';
        if (Tools::isSubmit('submitCoolQuotes')) {
            Configuration::updateValue('COOLQUOTES_ACTIVE', (int) Tools::getValue('COOLQUOTES_ACTIVE'));
            Configuration::updateValue('COOLQUOTES_POSITION', Tools::getValue('COOLQUOTES_POSITION'));
            Configuration::updateValue('COOLQUOTES_LABEL', Tools::getValue('COOLQUOTES_LABEL'));
            Configuration::updateValue('COOLQUOTES_KIND', Tools::getValue('COOLQUOTES_KIND'));
            Configuration::updateValue('COOLQUOTES_COUNT', max(1, min(20, (int) Tools::getValue('COOLQUOTES_COUNT'))));
            Configuration::updateValue('COOLQUOTES_SOUND', (int) Tools::getValue('COOLQUOTES_SOUND'));
            Configuration::updateValue('COOLQUOTES_MUSIC', (int) Tools::getValue('COOLQUOTES_MUSIC'));
            Configuration::updateValue('COOLQUOTES_VOLUME', max(0, min(100, (int) Tools::getValue('COOLQUOTES_VOLUME'))));
            Configuration::updateValue('COOLQUOTES_DELAY', max(10, min(600, (int) Tools::getValue('COOLQUOTES_DELAY'))));
            Configuration::updateValue('COOLQUOTES_HIDE_CHECKOUT', (int) Tools::getValue('COOLQUOTES_HIDE_CHECKOUT'));
            Configuration::updateValue('COOLQUOTES_AUTO_OPEN', (int) Tools::getValue('COOLQUOTES_AUTO_OPEN'));
            Configuration::updateValue('COOLQUOTES_KEEP_DATA', (int) Tools::getValue('COOLQUOTES_KEEP_DATA'));
            Configuration::updateValue('ZM40_NET_ENABLED', (int) Tools::getValue('ZM40_NET_ENABLED'));
            Zm40CommonCq::clearFeedCache();
            $out .= $this->displayConfirmation($this->l('Réglages enregistrés.'));
        }

        $this->context->smarty->assign([
            'zm40_ah_name' => $this->displayName,
            'zm40_ah_sub' => $this->l('Une citation qui se déplie au clic'),
            'zm40_ah_version' => $this->version,
            'zm40_ah_shop' => Configuration::get('PS_SHOP_NAME'),
            'cq_total' => (int) Db::getInstance()->getValue(
                'SELECT COUNT(*) FROM `' . _DB_PREFIX_ . 'coolquote`'
            ),
            'cq_manage_url' => $this->context->link->getAdminLink('AdminCoolQuotes'),
            'zm40_update' => Zm40CommonCq::checkUpdate($this->name, $this->version),
            'zm40_footer_html' => Zm40CommonCq::footer($this->displayName, $this->version, $this->name),
            'zm40_modules' => Zm40CommonCq::modulesFeed($this->name),
            'zm40_about_name' => $this->displayName,
            'zm40_about_license' => 'OSL 3.0',
            'zm40_about_github' => Zm40CommonCq::githubUrl($this->name),
            'zm40_about_site' => Zm40CommonCq::siteUrl($this->name, 'panel', '/contact'),
            'zm40_about_modules' => Zm40CommonCq::siteUrl($this->name, 'panel', '/'),
        ]);

        return $out
            . $this->display(__FILE__, 'views/templates/admin/configure_top.tpl')
            . $this->renderSettingsForm()
            . $this->display(__FILE__, 'views/templates/admin/configure_bottom.tpl');
    }

    private function renderSettingsForm()
    {
        $yesno = [
            ['id' => 'on', 'value' => 1, 'label' => $this->l('Oui')],
            ['id' => 'off', 'value' => 0, 'label' => $this->l('Non')],
        ];
        $fields = [
            'form' => [
                'legend' => ['title' => $this->l('Réglages'), 'icon' => 'icon-cogs'],
                'input' => [
                    ['type' => 'switch', 'label' => $this->l('Activer l\'affichage'),
                     'name' => 'COOLQUOTES_ACTIVE', 'is_bool' => true, 'values' => $yesno],
                    ['type' => 'select', 'label' => $this->l('Coin d\'affichage'),
                     'name' => 'COOLQUOTES_POSITION',
                     'options' => ['query' => [
                         ['id' => 'bottom-left', 'name' => $this->l('En bas à gauche')],
                         ['id' => 'bottom-right', 'name' => $this->l('En bas à droite')],
                     ], 'id' => 'id', 'name' => 'name']],
                    ['type' => 'text', 'label' => $this->l('Texte du bouton'),
                     'name' => 'COOLQUOTES_LABEL',
                     'desc' => $this->l('Visible au survol et pour les lecteurs d\'écran.')],
                    ['type' => 'text', 'label' => $this->l('Mot d\'appel'),
                     'name' => 'COOLQUOTES_KIND',
                     'desc' => $this->l('Affiché à côté du cercle, tant que la bande est fermée : « Une pensée », « Un haïku », « Inspiration »… Une fois ouverte, c\'est le genre de la citation affichée qui prend le relais. Videz le champ pour ne rien annoncer.')],
                    ['type' => 'text', 'label' => $this->l('Citations envoyées par page'),
                     'name' => 'COOLQUOTES_COUNT', 'class' => 'fixed-width-xs',
                     'desc' => $this->l('Le visiteur passe de l\'une à l\'autre avec les flèches. De 1 à 20 ; au-delà de 1, les flèches et le compteur apparaissent.')],
                    ['type' => 'switch', 'label' => $this->l('Ouvrir automatiquement'),
                     'name' => 'COOLQUOTES_AUTO_OPEN', 'is_bool' => true, 'values' => $yesno,
                     'desc' => $this->l('Déconseillé : une ouverture spontanée interrompt la visite. Au clic, c\'est le visiteur qui décide.')],
                    ['type' => 'switch', 'label' => $this->l('Appel sonore'),
                     'name' => 'COOLQUOTES_SOUND', 'is_bool' => true, 'values' => $yesno,
                     'desc' => $this->l('Un bol tibétain frappé une fois pour inviter à lire. Le son est synthétisé : aucun fichier n\'est chargé. Les navigateurs interdisant tout son avant un geste du visiteur, l\'appel ne part qu\'après sa première interaction avec la page, et une seule fois par visite.')],
                    ['type' => 'text', 'label' => $this->l('Attendre avant l\'appel'),
                     'name' => 'COOLQUOTES_DELAY', 'class' => 'fixed-width-sm',
                     'suffix' => $this->l('secondes'),
                     'desc' => $this->l('Compté à partir du premier geste du visiteur, pour lui laisser le temps de visiter. De 10 à 600 secondes.')],
                    ['type' => 'switch', 'label' => $this->l('Musique pendant la lecture'),
                     'name' => 'COOLQUOTES_MUSIC', 'is_bool' => true, 'values' => $yesno,
                     'desc' => $this->l('Un bourdon et quelques notes pentatoniques, tant que la bande reste ouverte. Un bouton sur la bande permet au visiteur de couper le son, et son choix est retenu d\'une page à l\'autre.')],
                    ['type' => 'text', 'label' => $this->l('Volume'),
                     'name' => 'COOLQUOTES_VOLUME', 'class' => 'fixed-width-sm',
                     'suffix' => '%',
                     'desc' => $this->l('De 0 à 100. Le module plafonne de toute façon à la moitié du volume du navigateur : on invite, on ne réveille pas.')],
                    ['type' => 'switch', 'label' => $this->l('Masquer dans le tunnel d\'achat'),
                     'name' => 'COOLQUOTES_HIDE_CHECKOUT', 'is_bool' => true, 'values' => $yesno,
                     'desc' => $this->l('Recommandé : on ne distrait pas un client en train de commander.')],
                    ['type' => 'switch', 'label' => $this->l('Conserver les citations à la désinstallation'),
                     'name' => 'COOLQUOTES_KEEP_DATA', 'is_bool' => true, 'values' => $yesno],
                    ['type' => 'switch', 'label' => $this->l('Fonctions réseau ZM40'),
                     'name' => 'ZM40_NET_ENABLED', 'is_bool' => true, 'values' => $yesno,
                     'desc' => $this->l('Vérifie qu\'une nouvelle version du module existe et affiche les autres modules ZM40. Aucune donnée de votre boutique n\'est transmise. Désactivez pour couper tout appel sortant.')],
                ],
                'submit' => ['title' => $this->l('Enregistrer')],
            ],
        ];

        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->submit_action = 'submitCoolQuotes';
        $helper->default_form_language = (int) Configuration::get('PS_LANG_DEFAULT');
        $helper->tpl_vars = ['fields_value' => [
            'COOLQUOTES_ACTIVE' => Configuration::get('COOLQUOTES_ACTIVE'),
            'COOLQUOTES_POSITION' => Configuration::get('COOLQUOTES_POSITION'),
            'COOLQUOTES_LABEL' => Configuration::get('COOLQUOTES_LABEL'),
            'COOLQUOTES_KIND' => Configuration::get('COOLQUOTES_KIND'),
            'COOLQUOTES_COUNT' => (int) Configuration::get('COOLQUOTES_COUNT'),
            'COOLQUOTES_SOUND' => Configuration::get('COOLQUOTES_SOUND'),
            'COOLQUOTES_MUSIC' => Configuration::get('COOLQUOTES_MUSIC'),
            'COOLQUOTES_VOLUME' => (int) Configuration::get('COOLQUOTES_VOLUME'),
            'COOLQUOTES_DELAY' => (int) Configuration::get('COOLQUOTES_DELAY'),
            'COOLQUOTES_AUTO_OPEN' => Configuration::get('COOLQUOTES_AUTO_OPEN'),
            'COOLQUOTES_HIDE_CHECKOUT' => Configuration::get('COOLQUOTES_HIDE_CHECKOUT'),
            'COOLQUOTES_KEEP_DATA' => Configuration::get('COOLQUOTES_KEEP_DATA'),
            'ZM40_NET_ENABLED' => Configuration::get('ZM40_NET_ENABLED'),
        ]];

        return $helper->generateForm([$fields]);
    }

    /* ── Front ────────────────────────────────────────────────────── */

    public function hookActionFrontControllerSetMedia($params)
    {
        if (!$this->isDisplayable()) {
            return;
        }
        $this->context->controller->registerStylesheet(
            'coolquotes', 'modules/' . $this->name . '/views/css/coolquotes.css',
            ['media' => 'all', 'priority' => 200]
        );
        $this->context->controller->registerJavascript(
            'coolquotes', 'modules/' . $this->name . '/views/js/coolquotes.js',
            ['position' => 'bottom', 'priority' => 200]
        );
        // L'audio ne pèse sur personne tant que le marchand ne l'a pas demandé.
        if (Configuration::get('COOLQUOTES_SOUND') || Configuration::get('COOLQUOTES_MUSIC')) {
            $this->context->controller->registerJavascript(
                'coolquotes-audio', 'modules/' . $this->name . '/views/js/coolquotes-audio.js',
                ['position' => 'bottom', 'priority' => 201]
            );
        }
    }

    public function hookDisplayBeforeBodyClosingTag($params)
    {
        if (!$this->isDisplayable()) {
            return '';
        }
        $idLang = (int) $this->context->language->id;
        $quotes = CoolQuote::pickSeveral(
            $this->currentCategoryId(),
            $idLang,
            (int) Configuration::get('COOLQUOTES_COUNT') ?: 8
        );
        if (!$quotes) {
            return '';
        }
        $this->context->smarty->assign([
            'cq_quotes' => $quotes,
            'cq_position' => Configuration::get('COOLQUOTES_POSITION') ?: 'bottom-left',
            'cq_label' => Configuration::get('COOLQUOTES_LABEL') ?: $this->l('Tirer une citation'),
            'cq_kind' => Configuration::get('COOLQUOTES_KIND'),
            'cq_prev' => $this->l('Citation précédente'),
            'cq_next' => $this->l('Citation suivante'),
            'cq_close' => $this->l('Fermer'),
            'cq_mute' => $this->l('Couper ou remettre le son'),
            'cq_sound' => (int) Configuration::get('COOLQUOTES_SOUND'),
            'cq_music' => (int) Configuration::get('COOLQUOTES_MUSIC'),
            'cq_volume' => (int) Configuration::get('COOLQUOTES_VOLUME'),
            'cq_delay' => (int) Configuration::get('COOLQUOTES_DELAY'),
            'cq_auto' => (int) Configuration::get('COOLQUOTES_AUTO_OPEN'),
        ]);

        return $this->display(__FILE__, 'views/templates/hook/panel.tpl');
    }

    /** Affiche-t-on le module sur cette page ? */
    private function isDisplayable()
    {
        if (!Configuration::get('COOLQUOTES_ACTIVE')) {
            return false;
        }
        $ctrl = $this->context->controller;
        if (Configuration::get('COOLQUOTES_HIDE_CHECKOUT') && $ctrl
            && in_array(strtolower((string) $ctrl->php_self), self::CHECKOUT_CONTROLLERS, true)) {
            return false;
        }

        return true;
    }

    /** Catégorie courante : page catégorie, ou catégorie par défaut du produit. */
    private function currentCategoryId()
    {
        $id = (int) Tools::getValue('id_category');
        if ($id) {
            return $id;
        }
        $idProduct = (int) Tools::getValue('id_product');
        if ($idProduct) {
            return (int) Db::getInstance()->getValue('SELECT id_category_default FROM `'
                . _DB_PREFIX_ . 'product` WHERE id_product = ' . $idProduct);
        }

        return 0;
    }
}
