{**
 * CoolQuotes — bas de la page de configuration : bloc open source, autres
 * modules ZM40, footer d'attribution.
 *
 * @author    ZM40 — Nicolas Michaud (Magic Garden)
 * @copyright 2026 Nicolas Michaud — ZM40 / Magic Garden
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License version 3.0
 *}
{include file="./_partials/zm40_panel.tpl"}

{if isset($zm40_modules) && $zm40_modules|@count}
    <div class="panel">
        <div class="panel-heading"><i class="icon-th-large"></i> {l s='Les autres modules ZM40' mod='coolquotes'}</div>
        {include file="./_partials/zm40_modules.tpl"}
    </div>
{/if}

{include file="./_partials/zm40_footer.tpl"}
