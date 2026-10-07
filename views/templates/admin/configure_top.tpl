{**
 * CoolQuotes — haut de la page de configuration : en-tête ZM40, notice de
 * mise à jour, puis les onglets (Configuration : bibliothèque et réglages ;
 * Modules ZM40 : la liste, puis l'interrupteur réseau).
 *
 * @author    ZM40 — Nicolas Michaud (Magic Garden)
 * @copyright 2026 Nicolas Michaud — ZM40 / Magic Garden
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License version 3.0
 *}
<link rel="stylesheet" href="{$module_dir|escape:'html':'UTF-8'}views/css/zm40-common.css">

{include file="./_partials/zm40_update.tpl"}

<style>
.zm40-ah { background: linear-gradient(135deg, #7D9B76 0%, #3B4A38 100%); color:#fff; padding:28px 32px; border-radius:8px; margin-bottom:24px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; }
.zm40-ah * { box-sizing:border-box; }
.zm40-ah h2 { margin:0; font-size:22px; font-weight:600; color:#fff; line-height:1.2; }
.zm40-ah-sub { opacity:.85; font-size:13px; margin-top:4px; color:#fff; }
.zm40-ah-badge { background:rgba(255,255,255,.2); padding:6px 14px; border-radius:20px; font-size:12px; font-weight:500; color:#fff; white-space:nowrap; }
.zm40-tabs { display:flex; gap:4px; border-bottom:2px solid #e5e7eb; margin:0 0 24px; padding:0; list-style:none; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif; }
.zm40-tabs li { padding:12px 22px; cursor:pointer; border-bottom:2px solid transparent; margin-bottom:-2px; font-weight:600; font-size:14px; color:#6b7280; transition:all .15s ease; user-select:none; }
.zm40-tabs li:hover { color:#3B4A38; }
.zm40-tabs li.is-active { color:#3B4A38; border-bottom-color:#3B4A38; }
.zm40-tabs li .icon { margin-right:8px; font-size:13px; opacity:.7; }
.zm40-tab-content { display:none; }
.zm40-tab-content.is-active { display:block; }
</style>
<div class="zm40-ah">
    <div>
        <h2>{$zm40_ah_name|escape:'html':'UTF-8'}</h2>
        <div class="zm40-ah-sub">{$zm40_ah_sub|escape:'html':'UTF-8'} &middot; v{$zm40_ah_version|escape:'html':'UTF-8'}</div>
    </div>
    {if isset($zm40_ah_shop) && $zm40_ah_shop}<span class="zm40-ah-badge">{$zm40_ah_shop|escape:'html':'UTF-8'}</span>{/if}
</div>

<ul class="zm40-tabs" id="zm40-tabs">
    <li data-tab="config"><i class="icon icon-cogs"></i>{l s='Configuration' mod='coolquotes'}</li>
    <li data-tab="ecosystem"><i class="icon icon-th-large"></i>{l s='Modules ZM40' mod='coolquotes'}</li>
</ul>

{* ===== Onglet 1 : CONFIGURATION ===== *}
<div class="zm40-tab-content" data-content="config">
<div class="panel">
    <h3><i class="icon-quote-left"></i> {l s='Votre bibliothèque' mod='coolquotes'}</h3>
    <p>
        {if $cq_total}
            <strong>{$cq_total|intval}</strong> {l s='citation(s) en base.' mod='coolquotes'}
        {else}
            {l s='Aucune citation pour le moment : ajoutez-en une pour que le module s\'affiche en boutique.' mod='coolquotes'}
        {/if}
    </p>
    <a class="btn btn-primary" href="{$cq_manage_url|escape:'html':'UTF-8'}">
        <i class="icon-list"></i> {l s='Gérer les citations' mod='coolquotes'}
    </a>
</div>
{$cq_form nofilter}
</div>

{* ===== Onglet 2 : MODULES ZM40 ===== *}
<div class="zm40-tab-content" data-content="ecosystem">
    {if isset($zm40_modules) && $zm40_modules|@count}
        {include file="./_partials/zm40_modules.tpl"}
    {else}
        <div class="panel">
            <div class="panel-heading"><i class="icon-th-large"></i> {l s='Modules ZM40' mod='coolquotes'}</div>
            <p>{l s='Aucun module à afficher pour le moment.' mod='coolquotes'}</p>
        </div>
    {/if}
    {$cq_form_net nofilter}
</div>
