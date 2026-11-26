<?php
/**
 * CoolQuotes 1.0.1 : le texte du bouton livré en français devient vide, pour
 * que le module affiche « Tirer une citation » dans la langue du visiteur.
 * Un texte personnalisé par le marchand n'est pas touché.
 *
 * @author    ZM40 — Nicolas Michaud (Magic Garden)
 * @copyright 2026 Nicolas Michaud — ZM40 / Magic Garden
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License version 3.0
 */
if (!defined('_PS_VERSION_')) {
    exit;
}

function upgrade_module_1_0_1($module)
{
    if (Configuration::get('COOLQUOTES_LABEL') === 'Tirer une citation') {
        Configuration::updateValue('COOLQUOTES_LABEL', '');
    }

    return true;
}
