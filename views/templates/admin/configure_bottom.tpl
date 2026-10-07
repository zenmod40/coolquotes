{**
 * CoolQuotes — bas de la page de configuration : bloc open source, footer
 * d'attribution, bascule des onglets.
 *
 * @author    ZM40 — Nicolas Michaud (Magic Garden)
 * @copyright 2026 Nicolas Michaud — ZM40 / Magic Garden
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License version 3.0
 *}
{include file="./_partials/zm40_panel.tpl"}

{include file="./_partials/zm40_footer.tpl"}

<script>
(function () {
    var tabs = document.querySelectorAll('#zm40-tabs li');
    var contents = document.querySelectorAll('.zm40-tab-content');
    function ouvrir(cible) {
        var li = document.querySelector('#zm40-tabs li[data-tab="' + cible + '"]');
        var pane = document.querySelector('.zm40-tab-content[data-content="' + cible + '"]');
        if (!li || !pane) { return false; }
        tabs.forEach(function (x) { x.classList.remove('is-active'); });
        contents.forEach(function (x) { x.classList.remove('is-active'); });
        li.classList.add('is-active');
        pane.classList.add('is-active');
        try { localStorage.setItem('zm40_coolquotes_tab', cible); } catch (e) {}
        return true;
    }
    tabs.forEach(function (li) {
        li.addEventListener('click', function () { ouvrir(li.getAttribute('data-tab')); });
    });
    var memo = null;
    try { memo = localStorage.getItem('zm40_coolquotes_tab'); } catch (e) {}
    ouvrir(memo || 'config') || ouvrir('config');
})();
</script>
