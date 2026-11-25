{**
 * CoolQuotes — bouton ensō et bande de papier dépliable.
 * L'ouverture et la fermeture restent portées par un <details> natif : elles
 * marchent au clavier et sans JavaScript. Le script ne fait que passer d'une
 * citation à l'autre, parmi celles déjà présentes dans la page.
 *}
<details class="cq{if $cq_position == 'bottom-right'} cq--right{/if}"{if $cq_auto} open{/if}
         data-cq-sound="{$cq_sound|intval}" data-cq-music="{$cq_music|intval}"
         data-cq-volume="{$cq_volume|intval}" data-cq-delay="{$cq_delay|intval}">
  <summary class="cq__toggle" title="{$cq_label|escape:'html':'UTF-8'}" aria-label="{$cq_label|escape:'html':'UTF-8'}">
    <span class="cq__dot">
      <svg viewBox="0 0 64 64" width="34" height="34" aria-hidden="true" focusable="false">
        <path d="M50 16a24 24 0 1 0 6 14" fill="none" stroke="currentColor"
              stroke-width="5" stroke-linecap="round"/>
      </svg>
    </span>
    {if $cq_kind}<span class="cq__kind">{$cq_kind|escape:'html':'UTF-8'}</span>{/if}
  </summary>
  <div class="cq__paper">
    {if $cq_music}
      <button type="button" class="cq__mute" aria-pressed="false" aria-label="{$cq_mute|escape:'html':'UTF-8'}">
        <svg viewBox="0 0 24 24" width="15" height="15" aria-hidden="true" focusable="false">
          <path d="M4 9h3l4-3.5v13L7 15H4z" fill="currentColor"/>
          <g class="cq__wave" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
            <path d="M15 9.2a4 4 0 0 1 0 5.6"/>
            <path d="M17.6 6.6a7.6 7.6 0 0 1 0 10.8"/>
          </g>
          <path class="cq__slash" d="M15.5 9.5l5 5m0-5l-5 5" fill="none"
                stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
        </svg>
      </button>
    {/if}
    <button type="button" class="cq__close" aria-label="{$cq_close|escape:'html':'UTF-8'}">&times;</button>
    <div class="cq__slides" aria-live="polite">
      {foreach $cq_quotes as $q}
        {assign var=cq_head value=($q.kind) ? $q.kind : $cq_kind}
        <figure class="cq__slide{if $q@first} is-current{/if}">
          {if $cq_head}<p class="cq__head">{$cq_head|escape:'html':'UTF-8'}</p>{/if}
          <blockquote class="cq__text">{$q.text nofilter}</blockquote>
          {if $q.author}<figcaption class="cq__author">{$q.author|escape:'html':'UTF-8'}</figcaption>{/if}
          {if $q.theme == 'vin'}<p class="cq__notice">{$cq_alcohol|escape:'html':'UTF-8'}</p>{/if}
        </figure>
      {/foreach}
    </div>
    {if $cq_quotes|@count > 1}
      <nav class="cq__nav">
        <button type="button" class="cq__arrow" data-step="-1" aria-label="{$cq_prev|escape:'html':'UTF-8'}">&lsaquo;</button>
        <span class="cq__count"><span class="cq__now">1</span> / {$cq_quotes|@count}</span>
        <button type="button" class="cq__arrow" data-step="1" aria-label="{$cq_next|escape:'html':'UTF-8'}">&rsaquo;</button>
      </nav>
    {/if}
  </div>
</details>
