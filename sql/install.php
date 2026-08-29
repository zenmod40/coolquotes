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

return [
    'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'coolquote` (
        `id_coolquote` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
        `theme` VARCHAR(32) NOT NULL DEFAULT \'\',
        `kind` VARCHAR(32) NOT NULL DEFAULT \'\',
        `categories` VARCHAR(255) NOT NULL DEFAULT \'\',
        `active` TINYINT(1) NOT NULL DEFAULT 1,
        `position` INT(11) UNSIGNED NOT NULL DEFAULT 0,
        PRIMARY KEY (`id_coolquote`),
        KEY `active` (`active`)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8mb4;',

    'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'coolquote_lang` (
        `id_coolquote` INT(11) UNSIGNED NOT NULL,
        `id_lang` INT(11) UNSIGNED NOT NULL,
        `text` TEXT NOT NULL,
        `author` VARCHAR(128) NOT NULL DEFAULT \'\',
        PRIMARY KEY (`id_coolquote`, `id_lang`)
    ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8mb4;',
];
