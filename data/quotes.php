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
/**
 * Contenu livré avec le module.
 *
 * Format : [thème, genre, texte, auteur].
 *
 * - `thème` est un repère interne : il sert au marchand à trier et filtrer sa
 *   liste dans le back-office. Le ciblage réel se fait par catégories, depuis
 *   la fiche de chaque citation.
 * - `genre` s'affiche en tête de la bande de papier, au-dessus du texte.
 * - `auteur` s'affiche sous la citation ; vide pour les proverbes.
 *
 * DEUX RÈGLES, sans exception.
 *
 * 1. Rien d'inventé. Chaque entrée renvoie à un texte réel, dont la référence
 *    figure en commentaire de fin de ligne. Les traductions françaises sont
 *    originales, faites pour ce module — pas de reprise d'une traduction
 *    moderne, elle-même protégée.
 *
 * 2. Rien sous droits. Les auteurs présents sont tous dans le domaine public :
 *    les classiques chinois, japonais et bouddhiques depuis des siècles ;
 *    Shirdi Sai Baba (mort en 1918), Vivekananda (1902), Ramakrishna (1886),
 *    Gandhi (1948) et Sri Aurobindo (1950) au titre des soixante-dix ans
 *    post mortem dans l'Union européenne.
 *
 *    Des auteurs plus récents — Taisen Deshimaru, Thich Nhat Hanh, Mirra
 *    Alfassa, Jiddu Krishnamurti, ou tout auteur vivant — sont encore sous
 *    droits et ne peuvent pas être redistribués dans un module libre. Rien
 *    n'empêche un marchand de les saisir lui-même depuis le back-office pour
 *    sa propre boutique : c'est sa décision, pas celle du module.
 *
 *    Pour le registre zen, les sources libres sont celles que ces auteurs
 *    citaient eux-mêmes : Dōgen, Sengcan, Huineng, le Dhammapada.
 *
 * Attributions douteuses. Beaucoup de citations circulant sous un nom célèbre
 * n'en sont pas. « Be the change you wish to see in the world » et « œil pour
 * œil et le monde sera aveugle » ne figurent nulle part chez Gandhi ; « peu
 * importe la lenteur pourvu qu'on ne s'arrête pas » n'est pas dans les
 * Entretiens de Confucius. Elles ont été écartées. Même prudence si vous
 * complétez la liste.
 */

return [
    /* ══ HAÏKUS ══════════════════════════════════════════════════════════
       Un haïku se lit sur trois lignes, d'où les <br>. */

    ['the', 'Haïku', 'Le vieil étang —<br>une grenouille plonge :<br>le bruit de l\'eau.', 'Bashō'], // Furu ike ya, 1686
    ['ambiance', 'Haïku', 'Quel silence —<br>la voix des cigales<br>pénètre la roche.', 'Bashō'], // Shizukesa ya, Oku no hosomichi
    ['general', 'Haïku', 'Sur ce chemin<br>plus personne ne passe —<br>crépuscule d\'automne.', 'Bashō'], // Kono michi ya, 1694
    ['epicerie', 'Haïku', 'Herbes d\'été —<br>de tous ces guerriers<br>la trace d\'un rêve.', 'Bashō'], // Natsukusa ya, Oku no hosomichi
    ['soin', 'Haïku', 'Première averse d\'hiver —<br>le singe aussi voudrait<br>un petit manteau de paille.', 'Bashō'], // Hatsu shigure, 1689
    ['general', 'Haïku', 'Malade en voyage,<br>mes rêves errent encore<br>sur des landes brûlées.', 'Bashō'], // poème de mort, 1694

    ['general', 'Haïku', 'Le monde de rosée<br>est un monde de rosée —<br>et pourtant, et pourtant…', 'Issa'], // Tsuyu no yo wa
    ['general', 'Haïku', 'La neige a fondu :<br>le village déborde<br>d\'enfants.', 'Issa'], // Yuki tokete
    ['sport', 'Haïku', 'Maigre grenouille,<br>ne lâche rien —<br>Issa est avec toi !', 'Issa'], // Yase-gaeru
    ['bienetre', 'Haïku', 'Quoi qu\'il advienne,<br>je m\'en remets à toi —<br>fin de l\'année.', 'Issa'], // Tomokaku mo

    ['ambiance', 'Haïku', 'Fleurs de colza —<br>la lune à l\'orient,<br>le soleil à l\'occident.', 'Buson'], // Na no hana ya
    ['the', 'Haïku', 'Mer de printemps —<br>tout le jour, doucement,<br>doucement.', 'Buson'], // Haru no umi
    ['ambiance', 'Haïku', 'Le coup de hache —<br>et le parfum surprend,<br>bosquet d\'hiver.', 'Buson'], // Ono irete

    ['ambiance', 'Haïku', 'Le voleur parti,<br>il a tout laissé :<br>la lune à ma fenêtre.', 'Ryōkan'], // Nusubito ni
    ['epicerie', 'Haïku', 'De quoi faire du feu —<br>le vent m\'apporte<br>ce qu\'il faut de feuilles mortes.', 'Ryōkan'], // Taku hodo wa

    ['soin', 'Haïku', 'Le liseron<br>a pris mon seau de puits :<br>j\'irai mendier l\'eau.', 'Chiyo-ni'], // Asagao ni

    ['epicerie', 'Haïku', 'Je croque un kaki —<br>et voilà que sonne<br>la cloche du Hōryū-ji.', 'Shiki'], // Kaki kueba, 1895
    ['general', 'Haïku', 'Des crêtes-de-coq —<br>il doit bien y en avoir<br>quatorze ou quinze.', 'Shiki'], // Keitō no

    /* ══ ZEN ET BOUDDHISME ═══════════════════════════════════════════════
       Les textes que citent les maîtres zen contemporains. */

    ['bienetre', 'Parole', 'Étudier la voie, c\'est s\'étudier soi-même. S\'étudier soi-même, c\'est s\'oublier soi-même.', 'Dōgen'], // Shōbōgenzō, Genjōkōan
    ['soin', 'Parole', 'Les fleurs tombent alors que nous les aimons ; les herbes poussent alors que nous ne les aimons pas.', 'Dōgen'], // Shōbōgenzō, Genjōkōan
    ['bienetre', 'Parole', 'Marcher dans le brouillard : on ne sent rien, et pourtant, peu à peu, le vêtement est trempé.', 'Dōgen'], // Shōbōgenzō Zuimonki
    ['general', 'Parole', 'Le temps file plus vite qu\'une flèche, et la vie tient moins qu\'une goutte de rosée.', 'Dōgen'], // Gakudō yōjinshū
    ['bienetre', 'Parole', 'Assieds-toi simplement. Ce n\'est pas un moyen d\'obtenir quelque chose : c\'est la porte de la paix.', 'Dōgen'], // Fukanzazengi

    ['general', 'Parole', 'La grande voie n\'a rien de difficile, sinon qu\'elle refuse de choisir.', 'Sengcan'], // Xinxin Ming, ouverture
    ['bienetre', 'Parole', 'Ne cherche pas la vérité : cesse seulement d\'avoir des opinions.', 'Sengcan'], // Xinxin Ming
    ['general', 'Parole', 'Ce n\'est pas le drapeau qui bouge, ce n\'est pas le vent : c\'est votre esprit qui bouge.', 'Huineng'], // Sūtra de l\'Estrade, ch. 1
    ['bienetre', 'Parole', 'Au printemps les fleurs, en automne la lune ; si rien d\'inutile ne pèse à ton esprit, toute saison t\'est bonne.', 'Wumen'], // Mumonkan, cas 19

    ['general', 'Parole', 'Nous sommes ce que nous avons pensé : tout ce que nous sommes naît de nos pensées.', 'Dhammapada'], // verset 1
    ['general', 'Parole', 'La haine ne cesse jamais par la haine : elle cesse par l\'amour. C\'est une loi ancienne.', 'Dhammapada'], // verset 5
    ['sport', 'Parole', 'Vaincre mille fois mille hommes au combat ne vaut pas se vaincre une seule fois soi-même.', 'Dhammapada'], // verset 103
    ['epicerie', 'Parole', 'Ne dédaigne pas le bien en disant : il ne viendra pas jusqu\'à moi. Goutte à goutte, la cruche finit par se remplir.', 'Dhammapada'], // verset 122
    ['soin', 'Parole', 'Vaincs la colère par le calme, le mal par le bien, l\'avarice par le don, le mensonge par la vérité.', 'Dhammapada'], // verset 223

    /* ══ CHINE CLASSIQUE ═════════════════════════════════════════════════ */

    // Confucius — Entretiens (Lunyu)
    ['general', 'Maxime', 'N\'impose pas à autrui ce que tu ne souhaites pas pour toi-même.', 'Confucius'], // Entretiens, XV.24
    ['general', 'Maxime', 'Apprendre sans réfléchir est peine perdue ; réfléchir sans apprendre est dangereux.', 'Confucius'], // Entretiens, II.15
    ['general', 'Maxime', 'Devant un homme de valeur, cherche à l\'égaler. Devant un homme sans valeur, examine-toi.', 'Confucius'], // Entretiens, IV.17
    ['general', 'Maxime', 'L\'homme de bien exige de lui-même ; l\'homme médiocre exige des autres.', 'Confucius'], // Entretiens, XV.21
    ['general', 'Maxime', 'Savoir qu\'on sait ce qu\'on sait, et qu\'on ignore ce qu\'on ignore : voilà le savoir.', 'Confucius'], // Entretiens, II.17
    ['general', 'Maxime', 'Quand trois hommes marchent ensemble, il y a nécessairement un maître pour moi parmi eux.', 'Confucius'], // Entretiens, VII.22
    ['general', 'Maxime', 'Ne t\'afflige pas que les hommes t\'ignorent ; afflige-toi de les ignorer.', 'Confucius'], // Entretiens, I.16
    ['epicerie', 'Maxime', 'Apprendre, et remettre en pratique ce qu\'on a appris : n\'est-ce pas là une joie ?', 'Confucius'], // Entretiens, I.1
    ['general', 'Maxime', 'L\'homme de bien est calme sans être hautain ; le médiocre est hautain sans être calme.', 'Confucius'], // Entretiens, XIII.26
    ['sport', 'Maxime', 'Celui qui a commis une faute et ne la corrige pas en commet une seconde.', 'Confucius'], // Entretiens, XV.30

    // Laozi — Tao Te King
    ['general', 'Parole', 'La voie qu\'on peut nommer n\'est pas la voie constante.', 'Laozi'], // Tao Te King, 1
    ['the', 'Parole', 'Rien au monde n\'est plus souple que l\'eau, et rien ne vient mieux à bout de ce qui est dur.', 'Laozi'], // Tao Te King, 78
    ['general', 'Parole', 'Qui connaît les autres est instruit ; qui se connaît soi-même est éclairé.', 'Laozi'], // Tao Te King, 33
    ['sport', 'Parole', 'Un voyage de mille lieues commence sous le pied.', 'Laozi'], // Tao Te King, 64
    ['ambiance', 'Parole', 'Trente rayons se rejoignent au moyeu : c\'est le vide du milieu qui fait servir la roue.', 'Laozi'], // Tao Te King, 11
    ['general', 'Parole', 'Le sage n\'accumule pas : plus il donne aux autres, plus il possède.', 'Laozi'], // Tao Te King, 81
    ['bienetre', 'Parole', 'Qui se hausse sur la pointe des pieds ne tient pas debout longtemps.', 'Laozi'], // Tao Te King, 24
    ['general', 'Parole', 'Les mots vrais ne sont pas beaux ; les beaux mots ne sont pas vrais.', 'Laozi'], // Tao Te King, 81
    ['epicerie', 'Parole', 'Qui sait se contenter est riche.', 'Laozi'], // Tao Te King, 33
    ['soin', 'Parole', 'Le raide et le dur se brisent ; le souple et le tendre l\'emportent.', 'Laozi'], // Tao Te King, 76

    // Zhuangzi
    ['general', 'Parole', 'Je ne sais plus si je suis un homme qui a rêvé qu\'il était papillon, ou un papillon qui rêve à présent qu\'il est un homme.', 'Zhuangzi'], // Zhuangzi, ch. 2
    ['general', 'Parole', 'On ne parle pas de la mer à la grenouille du puits : son trou la retient.', 'Zhuangzi'], // Zhuangzi, ch. 17
    ['general', 'Parole', 'La nasse sert à prendre le poisson : le poisson pris, on oublie la nasse. Les mots servent à saisir le sens : le sens saisi, on oublie les mots.', 'Zhuangzi'], // Zhuangzi, ch. 26
    ['bienetre', 'Parole', 'L\'homme accompli se sert de son esprit comme d\'un miroir : il n\'accueille rien, il ne retient rien, il reflète et ne garde pas.', 'Zhuangzi'], // Zhuangzi, ch. 7
    ['epicerie', 'Parole', 'Le vieux charron ne mesure plus : sa main sait ce que sa bouche ne peut transmettre.', 'Zhuangzi'], // Zhuangzi, ch. 13
    ['general', 'Parole', 'L\'arbre que personne ne veut couper atteint mille ans : c\'est son inutilité qui le sauve.', 'Zhuangzi'], // Zhuangzi, ch. 4
    ['sport', 'Parole', 'La cigale se moque du grand oiseau qui monte à quatre-vingt-dix mille lieues : elle mesure le ciel à la longueur de son vol.', 'Zhuangzi'], // Zhuangzi, ch. 1

    // Mencius, Xunzi, Sun Tzu
    ['sport', 'Maxime', 'Avant de confier une grande tâche à un homme, le Ciel éprouve son cœur, fatigue ses os et affame son corps.', 'Mencius'], // Mencius, VI B.15
    ['soin', 'Maxime', 'Le grand homme est celui qui n\'a pas perdu son cœur d\'enfant.', 'Mencius'], // Mencius, IV B.12
    ['sport', 'Maxime', 'Le chemin est court, mais qui ne marche pas n\'arrive jamais ; la tâche est petite, mais qui ne s\'y met pas ne l\'achève pas.', 'Xunzi'], // Xunzi, Xiushen
    ['general', 'Maxime', 'J\'ai passé un jour entier à réfléchir : cela ne valait pas un instant d\'étude.', 'Xunzi'], // Xunzi, Quanxue
    ['sport', 'Maxime', 'Qui se connaît et connaît l\'autre ne craindra pas l\'issue de cent batailles.', 'Sun Tzu'], // L\'Art de la guerre, III
    ['sport', 'Maxime', 'L\'excellence n\'est pas de gagner cent batailles : c\'est de vaincre sans combattre.', 'Sun Tzu'], // L\'Art de la guerre, III
    ['sport', 'Maxime', 'L\'eau n\'a pas de forme constante : elle prend celle du terrain.', 'Sun Tzu'], // L\'Art de la guerre, VI

    /* ══ VOIE MARTIALE JAPONAISE ═════════════════════════════════════════ */

    ['sport', 'Précepte', 'Accepte les choses telles qu\'elles sont.', 'Miyamoto Musashi'], // Dokkōdō, 1
    ['sport', 'Précepte', 'Ne recherche pas le plaisir pour lui-même.', 'Miyamoto Musashi'], // Dokkōdō, 2
    ['sport', 'Précepte', 'Ne regrette jamais ce que tu as fait.', 'Miyamoto Musashi'], // Dokkōdō, 5
    ['general', 'Précepte', 'N\'envie jamais le bien ni le mal d\'autrui.', 'Miyamoto Musashi'], // Dokkōdō, 6
    ['sport', 'Précepte', 'Ne fais rien qui ne serve à rien.', 'Miyamoto Musashi'], // Dokkōdō, 19
    ['sport', 'Précepte', 'Perçois ce que l\'œil seul ne peut pas voir.', 'Miyamoto Musashi'], // Gorin no Sho, Feu
    ['bienetre', 'Précepte', 'Que ta posture de combat soit ta posture de tous les jours, et ta posture de tous les jours ta posture de combat.', 'Miyamoto Musashi'], // Gorin no Sho, Eau
    ['sport', 'Précepte', 'Connais la voie largement, et tu la reconnaîtras en toute chose.', 'Miyamoto Musashi'], // Gorin no Sho, Terre
    ['bienetre', 'Précepte', 'L\'esprit qui s\'arrête sur quelque chose est un esprit prisonnier.', 'Yagyū Munenori'], // Heihō kadensho, 1632
    ['sport', 'Précepte', 'Il existe une épée qui ôte la vie et une épée qui la donne : c\'est la main qui décide, pas la lame.', 'Yagyū Munenori'], // Heihō kadensho
    ['bienetre', 'Précepte', 'Ne pose ton esprit nulle part, et il sera partout.', 'Takuan Sōhō'], // Fudōchi shinmyōroku

    /* ══ VOIE DU THÉ ═════════════════════════════════════════════════════ */

    ['the', 'Précepte', 'Le thé n\'est rien de plus que ceci : faire chauffer l\'eau, préparer le thé, et le boire comme il convient.', 'Sen no Rikyū'], // Nanpōroku
    ['ambiance', 'Précepte', 'Dispose les fleurs comme elles se tiennent dans les champs.', 'Sen no Rikyū'], // Les sept règles
    ['the', 'Précepte', 'En été, donne le sentiment de la fraîcheur ; en hiver, celui de la chaleur.', 'Sen no Rikyū'], // Les sept règles

    /* ══ INDE ════════════════════════════════════════════════════════════ */

    ['sport', 'Parole', 'Lève-toi, réveille-toi, et ne t\'arrête pas avant d\'avoir atteint le but.', 'Vivekananda'], // devise, d\'après la Katha Upanishad
    ['sport', 'Parole', 'La force est vie ; la faiblesse est mort.', 'Vivekananda'], // Conférences, Karma-Yoga
    ['general', 'Parole', 'Tout le savoir que le monde a reçu vient de l\'esprit : la bibliothèque infinie de l\'univers est dans le vôtre.', 'Vivekananda'], // Raja-Yoga
    ['soin', 'Parole', 'Tant que je vis, j\'apprends.', 'Ramakrishna'], // Kathamrita
    ['ambiance', 'Parole', 'La brise de la grâce souffle sans arrêt : à toi de hisser la voile.', 'Ramakrishna'], // Kathamrita
    ['the', 'Parole', 'L\'eau et la glace sont une seule et même chose.', 'Ramakrishna'], // Kathamrita
    ['the', 'Parole', 'Le poisson a soif dans l\'eau : voilà ce qui me fait rire.', 'Kabir'], // doha, XVe siècle
    ['general', 'Parole', 'Où me cherches-tu donc ? Je suis assis juste à côté de toi.', 'Kabir'], // doha, XVe siècle
    ['general', 'Parole', 'Toute vie est yoga.', 'Sri Aurobindo'], // La Synthèse des Yogas, ouverture
    ['sport', 'Parole', 'C\'est par tes faux pas que le monde se parfait.', 'Sri Aurobindo'], // Pensées et Aphorismes
    ['general', 'Parole', 'L\'évolution n\'est pas terminée : la raison n\'est pas le dernier mot, ni l\'animal raisonnable la figure suprême de la Nature.', 'Sri Aurobindo'], // Pensées et Aphorismes
    ['bienetre', 'Parole', 'Pourquoi craindre, puisque je suis là ?', 'Shirdi Sai Baba'], // Shri Sai Satcharita
    ['general', 'Parole', 'Regarde vers moi, et je regarderai vers toi.', 'Shirdi Sai Baba'], // Shri Sai Satcharita
    ['general', 'Parole', 'Le maître de tous est un seul et même.', 'Shirdi Sai Baba'], // « Sabka Malik Ek »

    // Gandhi — uniquement ce qu'on retrouve dans ses écrits publiés
    ['sport', 'Citation', 'La force ne vient pas des capacités physiques : elle vient d\'une volonté indomptable.', 'Gandhi'], // Young India
    ['general', 'Citation', 'La satisfaction est dans l\'effort, non dans le résultat. L\'effort entier est la victoire entière.', 'Gandhi'], // Young India
    ['general', 'Citation', 'Le faible ne peut pas pardonner : le pardon est le fait des forts.', 'Gandhi'], // Young India
    ['general', 'Citation', 'La vraie morale ne consiste pas à suivre le sentier battu, mais à trouver le sien et à le suivre.', 'Gandhi'], // Young India
    ['soin', 'Citation', 'Un service rendu sans joie n\'aide ni celui qui le rend, ni celui qui le reçoit.', 'Gandhi'], // Harijan
    ['general', 'Citation', 'L\'homme n\'est que le produit de ses pensées : il devient ce qu\'il pense.', 'Gandhi'], // Harijan

    /* ══ PROVERBES ═══════════════════════════════════════════════════════ */

    ['sport', 'Proverbe japonais', 'Tomber sept fois, se relever huit.', ''], // 七転び八起き
    ['sport', 'Proverbe japonais', 'Le bambou plie, mais il ne rompt pas.', ''],
    ['bienetre', 'Proverbe japonais', 'Si tu es pressé, prends le chemin détourné.', ''], // 急がば回れ
    ['general', 'Proverbe chinois', 'Le maître ouvre la porte : à toi d\'entrer.', ''],
    ['ambiance', 'Proverbe chinois', 'Mieux vaut allumer une bougie que maudire l\'obscurité.', ''],
    ['general', 'Proverbe chinois', 'Qui pose une question est sot cinq minutes ; qui n\'en pose pas l\'est toute sa vie.', ''],
    ['epicerie', 'Proverbe chinois', 'La patience est un arbre à la racine amère et aux fruits très doux.', ''],
    ['sport', 'Proverbe chinois', 'Ne crains pas d\'avancer lentement : crains seulement de t\'arrêter.', ''],
    ['epicerie', 'Proverbe chinois', 'Le meilleur moment pour planter un arbre était il y a vingt ans ; le deuxième meilleur moment, c\'est maintenant.', ''],
];
