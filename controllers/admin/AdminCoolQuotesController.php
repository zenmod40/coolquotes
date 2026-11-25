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
 * Gestion des citations : liste, création, édition, suppression.
 * Repose sur le CRUD natif d'AdminController + ObjectModel.
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

class AdminCoolQuotesController extends ModuleAdminController
{
    /** Colonnes du CSV, dans l'ordre à l'export. L'import les repère par leur
     *  nom : l'ordre est libre et les colonnes inconnues sont ignorées. */
    const CSV_COLUMNS = ['theme', 'kind', 'text', 'author', 'categories', 'active'];

    /**
     * PrestaShop 9 a retiré l() des contrôleurs admin : sans ce relais, la
     * page tombe en UndefinedMethodError dès l'ouverture.
     */
    public function l($string, $class = null, $addslashes = false, $htmlentities = true)
    {
        if (method_exists(get_parent_class($this), 'l')) {
            return parent::l($string, $class, $addslashes, $htmlentities);
        }
        if (method_exists($this, 'trans')) {
            return $this->trans($string, [], 'Modules.Coolquotes.Admin');
        }

        return $string;
    }

    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'coolquote';
        $this->className = 'CoolQuote';
        $this->identifier = 'id_coolquote';
        $this->lang = true;
        $this->position_identifier = 'position';
        $this->_defaultOrderBy = 'position';
        // L'export natif passe par fields_list, dont le callback tronque le
        // texte à 90 caractères : il donnerait un fichier non réimportable.
        // On fournit le nôtre, qui parle le même format que l'import.
        $this->allow_export = false;

        parent::__construct();

        $this->fields_list = [
            'id_coolquote' => ['title' => $this->l('ID'), 'align' => 'center', 'class' => 'fixed-width-xs'],
            'text' => ['title' => $this->l('Citation'), 'callback' => 'formatQuote', 'orderby' => false, 'search' => true],
            'author' => ['title' => $this->l('Auteur'), 'width' => 140],
            'kind' => ['title' => $this->l('Genre'), 'width' => 110, 'filter_key' => 'a!kind'],
            'theme' => ['title' => $this->l('Thème'), 'width' => 110, 'filter_key' => 'a!theme'],
            'categories' => ['title' => $this->l('Catégories ciblées'), 'callback' => 'formatCategories', 'orderby' => false, 'search' => false],
            'active' => ['title' => $this->l('Affichée'), 'active' => 'status', 'type' => 'bool', 'align' => 'center', 'class' => 'fixed-width-sm', 'orderby' => false],
        ];

        // Filtrer la liste sur un thème puis tout cocher : un thème entier
        // s'allume ou s'éteint en deux clics (méthodes natives d'AdminController).
        $this->bulk_actions = [
            'enableSelection' => ['text' => $this->l('Afficher la sélection'), 'icon' => 'icon-power-off text-success'],
            'disableSelection' => ['text' => $this->l('Masquer la sélection'), 'icon' => 'icon-power-off text-danger'],
            'divider' => ['text' => 'divider'],
            'delete' => ['text' => $this->l('Supprimer la sélection'), 'confirm' => $this->l('Supprimer ces citations ?'), 'icon' => 'icon-trash'],
        ];
    }

    /** Aperçu court, retours à la ligne rendus lisibles dans la liste. */
    public static function formatQuote($value)
    {
        $flat = trim(str_replace(['<br>', '<br />', '<br/>'], ' / ', (string) $value));

        return Tools::substr(strip_tags($flat), 0, 90) . (Tools::strlen($flat) > 90 ? '…' : '');
    }

    public static function formatCategories($value)
    {
        $ids = array_filter(array_map('intval', explode(',', (string) $value)));
        if (!$ids) {
            return '<em>' . Context::getContext()->getTranslator()->trans('Toutes les pages', [], 'Modules.Coolquotes.Admin') . '</em>';
        }
        $names = [];
        foreach ($ids as $id) {
            $c = new Category($id, (int) Context::getContext()->language->id);
            if (Validate::isLoadedObject($c)) {
                $names[] = $c->name;
            }
        }

        return implode(', ', $names);
    }

    public function renderForm()
    {
        $tree = new HelperTreeCategories('categories-tree', $this->l('Catégories ciblées'));
        $tree->setUseCheckBox(true)
            ->setUseSearch(true)
            ->setInputName('categories_box')
            ->setSelectedCategories($this->selectedCategories());

        $this->fields_form = [
            'legend' => ['title' => $this->l('Citation'), 'icon' => 'icon-quote-left'],
            'input' => [
                [
                    'type' => 'textarea',
                    'label' => $this->l('Texte'),
                    'name' => 'text',
                    'lang' => true,
                    'required' => true,
                    'autoload_rte' => false,
                    'rows' => 4,
                    'hint' => $this->l('Utilisez <br> pour aller à la ligne — un haïku se lit sur trois lignes. Une citation en prose n\'a besoin d\'aucune coupure.'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Auteur'),
                    'name' => 'author',
                    'lang' => true,
                    'hint' => $this->l('Laissez vide pour ne rien afficher sous la citation.'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Genre'),
                    'name' => 'kind',
                    'hint' => $this->l('Affiché en tête de la citation, au-dessus du texte : « Haïku », « Maxime », « Parole », « Précepte », « Proverbe chinois »… Laissez vide pour reprendre le mot d\'appel défini dans la configuration du module.'),
                ],
                [
                    'type' => 'text',
                    'label' => $this->l('Thème'),
                    'name' => 'theme',
                    'hint' => $this->l('Repère interne pour trier et filtrer votre liste — jamais affiché en boutique. Fonds zen livré : « the », « ambiance », « soin », « epicerie », « bienetre », « sport », « general ». Littérature française livrée masquée : « cuisine », « vin », « maison », « lecture », « voyage », « jardin », « amour », « elegance », « esprit ».'),
                ],
                [
                    'type' => 'html',
                    'label' => $this->l('Catégories ciblées'),
                    'name' => 'categories_tree',
                    'html_content' => $tree->render(),
                    'desc' => $this->l('Aucune sélection : la citation peut apparaître partout. Une sélection : elle est réservée à ces catégories (et aux produits qui y sont rangés).'),
                ],
                [
                    'type' => 'switch',
                    'label' => $this->l('Affichée'),
                    'name' => 'active',
                    'is_bool' => true,
                    'values' => [
                        ['id' => 'on', 'value' => 1, 'label' => $this->l('Oui')],
                        ['id' => 'off', 'value' => 0, 'label' => $this->l('Non')],
                    ],
                ],
            ],
            'submit' => ['title' => $this->l('Enregistrer')],
        ];

        return parent::renderForm();
    }

    private function selectedCategories()
    {
        $obj = $this->loadObject(true);
        if (!Validate::isLoadedObject($obj)) {
            return [];
        }

        return array_filter(array_map('intval', explode(',', (string) $obj->categories)));
    }

    /* ── Import / export CSV ──────────────────────────────────────── */

    public function postProcess()
    {
        if (Tools::isSubmit('cqExport')) {
            $this->exportCsv();
        }
        if (Tools::isSubmit('submitCqImport')) {
            $this->importCsv();
        }

        return parent::postProcess();
    }

    /** Le panneau d'import, posé au-dessus de la liste. */
    public function renderList()
    {
        $exportUrl = self::$currentIndex . '&cqExport&token=' . $this->token;
        $columns = implode(' ; ', self::CSV_COLUMNS);

        return '<div class="panel">'
            . '<div class="panel-heading"><i class="icon-upload"></i> ' . $this->l('Importer des citations') . '</div>'
            . '<form method="post" enctype="multipart/form-data" class="form-horizontal">'
            . '<div class="form-group"><div class="col-lg-8">'
            . '<input type="file" name="cq_csv" accept=".csv,text/csv" required>'
            . '<p class="help-block">'
            . $this->l('Fichier CSV avec une ligne d\'en-tête. Colonnes reconnues :') . ' <code>' . $columns . '</code>. '
            . $this->l('Seule « text » est obligatoire ; l\'ordre est libre et les colonnes inconnues sont ignorées. Séparateur point-virgule ou virgule, détecté automatiquement. Chaque ligne crée une citation : l\'import n\'écrase jamais l\'existant.')
            . '</p></div>'
            . '<div class="col-lg-4 text-right">'
            . '<button type="submit" name="submitCqImport" class="btn btn-primary">'
            . '<i class="icon-upload"></i> ' . $this->l('Importer') . '</button> '
            . '<a class="btn btn-default" href="' . htmlspecialchars($exportUrl, ENT_QUOTES, 'UTF-8') . '">'
            . '<i class="icon-download"></i> ' . $this->l('Exporter') . '</a>'
            . '</div></div></form></div>'
            . parent::renderList();
    }

    /** Envoie la bibliothèque au format que relit l'import, puis sort. */
    private function exportCsv()
    {
        $rows = Db::getInstance()->executeS(
            'SELECT q.theme, q.kind, ql.text, ql.author, q.categories, q.active
             FROM `' . _DB_PREFIX_ . 'coolquote` q
             JOIN `' . _DB_PREFIX_ . 'coolquote_lang` ql
               ON ql.id_coolquote = q.id_coolquote AND ql.id_lang = ' . (int) $this->context->language->id . '
             ORDER BY q.id_coolquote'
        );

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="coolquotes.csv"');
        $out = fopen('php://output', 'w');
        fwrite($out, "\xEF\xBB\xBF"); // sans BOM, Excel lit l'UTF-8 de travers
        fputcsv($out, self::CSV_COLUMNS, ';');
        foreach ((array) $rows as $r) {
            fputcsv($out, [
                $r['theme'], $r['kind'], $r['text'], $r['author'],
                $r['categories'], (int) $r['active'],
            ], ';');
        }
        fclose($out);
        exit;
    }

    private function importCsv()
    {
        $file = isset($_FILES['cq_csv']) ? $_FILES['cq_csv'] : null;
        if (!$file || $file['error'] !== UPLOAD_ERR_OK || !is_uploaded_file($file['tmp_name'])) {
            $this->errors[] = $this->l('Aucun fichier reçu.');

            return;
        }
        $handle = fopen($file['tmp_name'], 'r');
        if (!$handle) {
            $this->errors[] = $this->l('Fichier illisible.');

            return;
        }

        // Séparateur : celui qui domine la ligne d'en-tête.
        $first = (string) fgets($handle);
        $sep = substr_count($first, ';') >= substr_count($first, ',') ? ';' : ',';
        rewind($handle);

        $header = fgetcsv($handle, 0, $sep);
        if (!$header) {
            fclose($handle);
            $this->errors[] = $this->l('Fichier vide.');

            return;
        }
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
        $map = array_flip(array_map(function ($c) {
            return Tools::strtolower(trim((string) $c));
        }, $header));

        if (!isset($map['text'])) {
            fclose($handle);
            $this->errors[] = $this->l('Colonne « text » absente de la ligne d\'en-tête.');

            return;
        }

        $langs = Language::getLanguages(false);
        $added = 0;
        $skipped = 0;
        while (($row = fgetcsv($handle, 0, $sep)) !== false) {
            $cell = function ($name) use ($row, $map) {
                if (!isset($map[$name]) || !isset($row[$map[$name]])) {
                    return '';
                }
                $v = trim((string) $row[$map[$name]]);

                // Un CSV sorti d'Excel arrive souvent en Windows-1252.
                return mb_check_encoding($v, 'UTF-8')
                    ? $v
                    : mb_convert_encoding($v, 'UTF-8', 'Windows-1252');
            };

            $text = $cell('text');
            if ($text === '') {
                ++$skipped;
                continue;
            }

            $quote = new CoolQuote();
            $quote->theme = Tools::substr($cell('theme'), 0, 32);
            $quote->kind = Tools::substr($cell('kind'), 0, 32);
            $quote->categories = implode(',', array_filter(array_map(
                'intval',
                explode(',', $cell('categories'))
            )));
            $quote->active = $cell('active') === '0' ? 0 : 1;
            $quote->position = 0;
            foreach ($langs as $lang) {
                $quote->text[(int) $lang['id_lang']] = $text;
                $quote->author[(int) $lang['id_lang']] = Tools::substr($cell('author'), 0, 128);
            }

            if ($quote->add()) {
                ++$added;
            } else {
                ++$skipped;
            }
        }
        fclose($handle);

        $this->confirmations[] = sprintf(
            $this->l('%1$d citation(s) importée(s), %2$d ligne(s) ignorée(s).'),
            $added,
            $skipped
        );
    }

    /** L'arbre renvoie un tableau ; on le range en CSV. */
    public function processSave()
    {
        $boxes = Tools::getValue('categories_box');
        $_POST['categories'] = is_array($boxes)
            ? implode(',', array_filter(array_map('intval', $boxes)))
            : '';

        return parent::processSave();
    }

    public function initPageHeaderToolbar()
    {
        if (empty($this->display)) {
            $this->page_header_toolbar_btn['new'] = [
                'href' => self::$currentIndex . '&addcoolquote&token=' . $this->token,
                'desc' => $this->l('Ajouter une citation'),
                'icon' => 'process-icon-new',
            ];
        }
        parent::initPageHeaderToolbar();
    }
}
