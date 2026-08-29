/**
 * CoolQuotes — appel sonore et musique de lecture.
 *
 * Chargé uniquement si le marchand a activé l'un des deux en configuration.
 *
 * Tout est synthétisé avec l'API Web Audio : aucun fichier, aucune requête,
 * aucune licence à traîner. Un bol tibétain, ce sont quelques partiels
 * inharmoniques qui décroissent à des vitesses différentes ; deux
 * oscillateurs très légèrement désaccordés par partiel donnent le battement
 * lent qu'on entend sur un bol frotté.
 *
 * Les navigateurs refusent tout son avant un geste du visiteur : on arme donc
 * au premier clic ou à la première touche. Cette contrainte règle au passage
 * l'ordre de chargement — le panneau existe forcément quand on le cherche.
 *
 * Le visiteur peut couper d'un bouton sur la bande, et son choix est retenu
 * d'une page à l'autre.
 */
(function () {
    var STORAGE_KEY = 'cq-muted';
    var CALLED_KEY = 'cq-called';

    var ctx = null;
    var armed = false;
    var music = null;
    var root = null;
    var volume = 0.35;

    /** L'appel ne sonne qu'une fois par visite, pas à chaque page ouverte. */
    function alreadyCalled() {
        try {
            return window.sessionStorage.getItem(CALLED_KEY) === '1';
        } catch (e) {
            return false;
        }
    }

    function markCalled() {
        try {
            window.sessionStorage.setItem(CALLED_KEY, '1');
        } catch (e) {
            // stockage refusé : l'appel vaudra pour la page courante
        }
    }

    function muted() {
        try {
            return window.localStorage.getItem(STORAGE_KEY) === '1';
        } catch (e) {
            return false;
        }
    }

    function setMuted(value) {
        try {
            window.localStorage.setItem(STORAGE_KEY, value ? '1' : '0');
        } catch (e) {
            // navigation privée ou stockage refusé : le choix vaut pour la page
        }
    }

    function context() {
        if (!ctx) {
            var Ctor = window.AudioContext || window.webkitAudioContext;
            if (!Ctor) {
                return null;
            }
            ctx = new Ctor();
        }
        if (ctx.state === 'suspended') {
            ctx.resume();
        }

        return ctx;
    }

    /* ── L'appel : un bol frappé une fois ──────────────────────────── */

    function bowl() {
        var ac = context();
        if (!ac) {
            return;
        }
        var now = ac.currentTime;
        var out = ac.createGain();
        out.gain.value = volume;
        out.connect(ac.destination);

        // rapports inharmoniques : c'est ce qui sépare un bol d'une cloche
        var partials = [
            { ratio: 1, level: 1, decay: 7 },
            { ratio: 2.75, level: 0.42, decay: 5 },
            { ratio: 5.38, level: 0.16, decay: 3.4 },
            { ratio: 8.93, level: 0.07, decay: 2.2 }
        ];

        partials.forEach(function (partial) {
            [-3, 3].forEach(function (detune) {
                var osc = ac.createOscillator();
                var gain = ac.createGain();
                osc.type = 'sine';
                osc.frequency.value = 196 * partial.ratio; // sol grave
                osc.detune.value = detune;
                gain.gain.setValueAtTime(0.0001, now);
                gain.gain.linearRampToValueAtTime(partial.level * 0.5, now + 0.012);
                gain.gain.exponentialRampToValueAtTime(0.0001, now + partial.decay);
                osc.connect(gain).connect(out);
                osc.start(now);
                osc.stop(now + partial.decay + 0.1);
            });
        });
    }

    /* ── La musique : un bourdon et quelques notes ─────────────────── */

    function startMusic() {
        var ac = context();
        if (!ac || music) {
            return;
        }
        var now = ac.currentTime;

        var out = ac.createGain();
        out.gain.setValueAtTime(0.0001, now);
        out.gain.linearRampToValueAtTime(volume * 0.5, now + 2.5); // fondu d'entrée
        out.connect(ac.destination);

        // Un écho court tient lieu de salle : bien moins cher qu'une réverbe
        // à convolution, et suffisant pour de la matière aussi lente.
        var delay = ac.createDelay(1.5);
        delay.delayTime.value = 0.42;
        var feedback = ac.createGain();
        feedback.gain.value = 0.3;
        delay.connect(feedback).connect(delay);
        delay.connect(out);

        music = { out: out, delay: delay, nodes: [], timer: null };

        // bourdon : fondamentale et quinte, très en dessous du reste
        [98, 146.83].forEach(function (frequency, index) {
            var osc = ac.createOscillator();
            var gain = ac.createGain();
            osc.type = 'sine';
            osc.frequency.value = frequency;
            gain.gain.value = index ? 0.05 : 0.08;
            osc.connect(gain).connect(out);
            osc.start(now);
            music.nodes.push(osc);
        });

        // pentatonique : aucun intervalle ne peut sonner faux
        var scale = [196, 220, 261.63, 293.66, 349.23, 392, 440];
        function pluck() {
            if (!music) {
                return;
            }
            var at = ac.currentTime;
            var osc = ac.createOscillator();
            var gain = ac.createGain();
            osc.type = 'sine';
            osc.frequency.value = scale[Math.floor(Math.random() * scale.length)];
            gain.gain.setValueAtTime(0.0001, at);
            gain.gain.linearRampToValueAtTime(0.11, at + 0.09);
            gain.gain.exponentialRampToValueAtTime(0.0001, at + 3.6);
            osc.connect(gain);
            gain.connect(music.out);
            gain.connect(music.delay);
            osc.start(at);
            osc.stop(at + 3.7);
            music.timer = window.setTimeout(pluck, 2800 + Math.random() * 4200);
        }
        music.timer = window.setTimeout(pluck, 1800);
    }

    function stopMusic() {
        if (!music) {
            return;
        }
        var ac = context();
        var current = music;
        music = null;
        window.clearTimeout(current.timer);

        if (!ac) {
            return;
        }
        var now = ac.currentTime;
        current.out.gain.cancelScheduledValues(now);
        current.out.gain.setValueAtTime(current.out.gain.value, now);
        current.out.gain.exponentialRampToValueAtTime(0.0001, now + 1.2); // fondu de sortie
        current.nodes.forEach(function (osc) {
            osc.stop(now + 1.3);
        });
    }

    /* ── Câblage ──────────────────────────────────────────────────── */

    function refreshButton() {
        var button = root && root.querySelector('.cq__mute');
        if (button) {
            button.classList.toggle('is-muted', muted());
            button.setAttribute('aria-pressed', muted() ? 'true' : 'false');
        }
    }

    function arm() {
        if (armed) {
            return;
        }
        armed = true;

        root = document.querySelector('.cq');
        if (!root) {
            return;
        }
        // 0 est un réglage valide : on ne le confond pas avec « non renseigné »
        var configured = parseInt(root.getAttribute('data-cq-volume'), 10);
        if (isNaN(configured)) {
            configured = 35;
        }
        volume = Math.min(100, Math.max(0, configured)) / 100 * 0.5;
        refreshButton();

        if (root.getAttribute('data-cq-music') === '1') {
            root.addEventListener('toggle', function () {
                if (root.open && !muted()) {
                    startMusic();
                } else {
                    stopMusic();
                }
            });
            if (root.open && !muted()) {
                startMusic();
            }
        }

        if (root.getAttribute('data-cq-sound') === '1' && !alreadyCalled()) {
            // Le compte à rebours part du premier geste, pas du chargement :
            // on laisse le visiteur s'installer avant de l'inviter.
            var delay = parseInt(root.getAttribute('data-cq-delay'), 10) || 90;
            window.setTimeout(function () {
                // on n'appelle ni celui qui lit déjà, ni un onglet en arrière-plan
                if (alreadyCalled() || root.open || muted() || document.hidden) {
                    return;
                }
                markCalled();
                bowl();
            }, Math.min(600, Math.max(10, delay)) * 1000);
        }
    }

    document.addEventListener('pointerdown', arm);
    document.addEventListener('keydown', arm);

    document.addEventListener('click', function (event) {
        var button = event.target.closest ? event.target.closest('.cq__mute') : null;
        if (!button) {
            return;
        }
        setMuted(!muted());
        refreshButton();
        if (muted()) {
            stopMusic();
        } else if (root && root.open && root.getAttribute('data-cq-music') === '1') {
            startMusic();
        }
    });
})();
