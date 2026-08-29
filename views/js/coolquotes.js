/**
 * CoolQuotes — navigation entre les citations déjà présentes dans la page.
 *
 * Le <details> natif porte l'ouverture et la fermeture ; ce script déplace la
 * citation courante et relaie la croix de fermeture. Aucun appel réseau,
 * aucune dépendance.
 *
 * L'écoute est déléguée à `document` : le JavaScript de bas de page est émis
 * par le thème avant le hook displayBeforeBodyClosingTag, donc le panneau
 * n'existe pas encore quand ce fichier s'exécute. La délégation s'affranchit
 * de l'ordre, et couvre au passage un panneau réinjecté par le thème.
 *
 * L'index courant est lu dans le DOM plutôt que gardé en variable : rien à
 * resynchroniser si la page change sous nos pieds.
 */
document.addEventListener('click', function (event) {
    if (!event.target.closest) {
        return;
    }

    var close = event.target.closest('.cq__close');
    if (close) {
        var box = close.closest('.cq');
        if (box) {
            box.removeAttribute('open');
        }

        return;
    }

    // Le voile est un pseudo-élément : un clic dessus a .cq elle-même pour
    // cible, jamais l'un de ses enfants. C'est le « cliquer à côté pour
    // fermer » attendu d'une fenêtre modale.
    var veil = event.target.closest('.cq');
    if (veil && veil.open && event.target === veil) {
        veil.removeAttribute('open');

        return;
    }

    var arrow = event.target.closest('.cq__arrow');
    if (!arrow) {
        return;
    }

    var paper = arrow.closest('.cq__paper');
    var slides = paper ? paper.querySelectorAll('.cq__slide') : [];
    var current = paper ? paper.querySelector('.cq__slide.is-current') : null;
    if (slides.length < 2 || !current) {
        return;
    }

    var step = parseInt(arrow.getAttribute('data-step'), 10) || 1;
    var index = Array.prototype.indexOf.call(slides, current);
    var next = (index + step + slides.length) % slides.length;

    current.classList.remove('is-current');
    slides[next].classList.add('is-current');

    var counter = paper.querySelector('.cq__now');
    if (counter) {
        counter.textContent = next + 1;
    }
});

/** Échap ferme, comme sur n'importe quelle fenêtre modale. */
document.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape' && event.key !== 'Esc') {
        return;
    }
    var open = document.querySelector('.cq[open]');
    if (open) {
        open.removeAttribute('open');
    }
});
