{**
 * CoolQuotes — haut de la page de configuration : en-tête ZM40, notice de
 * mise à jour, accès à la bibliothèque. Le formulaire de réglages, rendu par
 * HelperForm, s'insère juste en dessous.
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
</style>
<div class="zm40-ah">
    <div>
        <h2>{$zm40_ah_name|escape:'html':'UTF-8'}</h2>
        <div class="zm40-ah-sub">{$zm40_ah_sub|escape:'html':'UTF-8'} &middot; v{$zm40_ah_version|escape:'html':'UTF-8'}</div>
    </div>
    {if isset($zm40_ah_shop) && $zm40_ah_shop}<span class="zm40-ah-badge">{$zm40_ah_shop|escape:'html':'UTF-8'}</span>{/if}
</div>

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
