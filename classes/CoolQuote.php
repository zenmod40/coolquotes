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

if (!defined('_PS_VERSION_')) {
    exit;
}

/**
 * Une citation : texte, auteur, ciblage par catégories, position.
 */
class CoolQuote extends ObjectModel
{
    public $id_coolquote;
    public $theme;        // repère interne, jamais affiché en boutique
    public $kind;         // genre affiché en tête : Haïku, Maxime, Proverbe…
    public $categories;   // CSV d'id_category — vide = toutes les pages
    public $active;
    public $position;
    public $text;         // multilingue
    public $author;       // multilingue

    public static $definition = [
        'table' => 'coolquote',
        'primary' => 'id_coolquote',
        'multilang' => true,
        'fields' => [
            'theme' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 32],
            'kind' => ['type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 32],
            'categories' => ['type' => self::TYPE_STRING, 'validate' => 'isCleanHtml', 'size' => 255],
            'active' => ['type' => self::TYPE_BOOL, 'validate' => 'isBool'],
            'position' => ['type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'],
            'text' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml', 'required' => true, 'size' => 1000],
            'author' => ['type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 128],
        ],
    ];

    /**
     * Tire plusieurs citations pour cette catégorie : d'abord les ciblées,
     * complétées par le fonds commun si nécessaire. Ordre aléatoire.
     */
    public static function pickSeveral($idCategory, $idLang, $limit = 8)
    {
        [$targeted, $generic] = self::pools($idCategory, $idLang);
        shuffle($targeted);
        shuffle($generic);
        $pool = array_merge($targeted, $generic);

        return array_slice($pool, 0, max(1, (int) $limit));
    }

    /** @return array{0: array, 1: array} citations ciblées, fonds commun */
    private static function pools($idCategory, $idLang)
    {
        $idCategory = (int) $idCategory;
        $rows = Db::getInstance()->executeS('
            SELECT q.id_coolquote, q.categories, q.kind, q.theme, ql.text, ql.author
            FROM `' . _DB_PREFIX_ . 'coolquote` q
            JOIN `' . _DB_PREFIX_ . 'coolquote_lang` ql
              ON ql.id_coolquote = q.id_coolquote AND ql.id_lang = ' . (int) $idLang . '
            WHERE q.active = 1');
        $targeted = [];
        $generic = [];
        foreach ((array) $rows as $r) {
            // Le gabarit sort le texte en nofilter pour honorer les <br> d'un
            // haïku : on ne laisse donc passer que ceux-là.
            // strip_tags garde les attributs des balises permises : un
            // <br onmouseover=…> venu d'un CSV passerait. On les réécrit nues.
            $r['text'] = preg_replace('/<br\b[^>]*>/i', '<br>', strip_tags((string) $r['text'], '<br>'));
            $cats = array_filter(array_map('intval', explode(',', (string) $r['categories'])));
            if (!$cats) {
                $generic[] = $r;
            } elseif ($idCategory && in_array($idCategory, $cats, true)) {
                $targeted[] = $r;
            }
        }

        return [$targeted, $generic];
    }
}
