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
 * Entretiens de Confucius ; « mieux vaut allumer une bougie que maudire
 * l'obscurité » et « le meilleur moment pour planter un arbre était il y a
 * vingt ans » sont des formules anglaises modernes, sans origine chinoise.
 * Elles ont été écartées. Même prudence si vous
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
    ['sport', 'Proverbe japonais', 'Le saule ne rompt pas sous la neige.', ''], // 柳に雪折れなし
    ['bienetre', 'Proverbe japonais', 'Si tu es pressé, prends le chemin détourné.', ''], // 急がば回れ
    ['general', 'Proverbe chinois', 'Le maître ouvre la porte : à toi d\'entrer.', ''], // 师父领进门，修行在个人
    ['general', 'Proverbe japonais', 'Demander est une honte d\'un instant ; ne pas demander, la honte de toute une vie.', ''], // 聞くは一時の恥、聞かぬは一生の恥
    ['sport', 'Proverbe chinois', 'Ne crains pas d\'avancer lentement : crains seulement de t\'arrêter.', ''], // 不怕慢，只怕站
    ['epicerie', 'Citation', 'Pour un an, sème du grain ; pour dix ans, plante des arbres ; pour toute une vie, forme des hommes.', 'Guanzi'], // Guanzi, Quan xiu : 一年之計，莫如樹穀；十年之計，莫如樹木；終身之計，莫如樹人

    /* ══ LITTÉRATURE FRANÇAISE ═══════════════════════════════════════════
       Neuf thèmes pour d'autres boutiques que le registre zen, installés
       masqués (Coolquotes::SEED_THEMES_OFF) : le marchand allume ceux qui
       conviennent, depuis la liste filtrée sur le thème.

       Auteurs de langue française morts avant 1956, aucun « mort pour la
       France » (prorogation de trente ans). Chaque phrase a été retrouvée
       mot pour mot dans le texte de l'œuvre, sur fr.wikisource.org ; les
       proverbes, dans le Littré. Orthographe modernisée, mots inchangés ;
       une coupe dans la phrase est marquée […], une ponctuation finale
       ramenée à un point ou à des points de suspension quand la phrase
       continue. Loi Évin : le gabarit ajoute la mention sanitaire sous
       toute citation du thème « vin », et rien ici n'invite à boire. */

    // Cuisine
    ['cuisine', 'Aphorisme', 'Dis-moi ce que tu manges, je te dirai ce que tu es.', 'Brillat-Savarin'], // Physiologie du goût, Aphorismes du professeur, IV, 1825 — https://fr.wikisource.org/wiki/Physiologie_du_goût/Aphorismes_du_professeur
    ['cuisine', 'Aphorisme', 'La découverte d\'un mets nouveau fait plus pour le bonheur du genre humain que la découverte d\'une étoile.', 'Brillat-Savarin'], // Physiologie du goût, Aphorismes du professeur, IX, 1825 — même page
    ['cuisine', 'Aphorisme', 'La table est le seul endroit où l\'on ne s\'ennuie jamais pendant la première heure.', 'Brillat-Savarin'], // Physiologie du goût, Aphorismes du professeur, VIII, 1825 — même page
    ['cuisine', 'Citation', 'Il faut manger pour vivre, et non pas vivre pour manger.', 'Molière'], // L'Avare, III, 1 (Valère, « suivant le dire d'un ancien »), 1668 — https://fr.wikisource.org/wiki/L’Avare_(Molière)/Édition_Louandre,_1910/Acte_III
    ['cuisine', 'Vers', 'Je vis de bonne soupe, et non de beau langage.', 'Molière'], // Les Femmes savantes, II, 7 (Chrysale), 1672 — https://fr.wikisource.org/wiki/Les_Femmes_savantes/Édition_Louandre,_1910/Acte_II
    ['cuisine', 'Citation', 'L\'appétit vient en mangeant […] : la soif s\'en va en buvant.', 'Rabelais'], // Gargantua, chap. 5, 1534 ; coupe de l'incise « disoyt Angest on Mans » — https://fr.wikisource.org/wiki/Les_Œuvres_de_François_Rabelais_(Éditions_Marty-Laveaux)/Gargantua/5
    ['cuisine', 'Vers', 'Un dîner réchauffé ne valut jamais rien.', 'Boileau'], // Le Lutrin, chant I, 1674 — https://fr.wikisource.org/wiki/Boileau_-_Œuvres_poétiques/Le_Lutrin/Chant_1
    ['cuisine', 'Vers', 'Ventre affamé n\'a point d\'oreilles.', 'La Fontaine'], // Fables, IX, 18, Le Milan et le Rossignol, 1679 — https://fr.wikisource.org/wiki/Fables_de_La_Fontaine_(éd._1874)/Le_Milan_et_le_Rossignol
    ['cuisine', 'Proverbe', 'Il n\'est chère que d\'appétit.', ''], // Littré, art. APPÉTIT — https://www.littre.org/definition/appétit
    ['cuisine', 'Proverbe', 'Tel pain, telle soupe.', ''], // Littré, art. PAIN — https://www.littre.org/definition/pain

    // Vin
    ['vin', 'Aphorisme', 'L\'ordre des boissons est des plus tempérées aux plus fumeuses et aux plus parfumées.', 'Brillat-Savarin'], // Physiologie du goût, Aphorismes du professeur, XII, 1825 — https://fr.wikisource.org/wiki/Physiologie_du_goût/Aphorismes_du_professeur
    ['vin', 'Aphorisme', 'Prétendre qu\'il ne faut pas changer de vins est une hérésie ; la langue se sature.', 'Brillat-Savarin'], // Aphorismes du professeur, XIII, 1825 ; coupe de la fin de phrase — même page
    ['vin', 'Citation', 'Le vin, la plus aimable des boissons […] date de l\'enfance du monde.', 'Brillat-Savarin'], // Physiologie du goût, Méditation IX, § 53, 1825 ; coupe de l'incise sur Noé et Bacchus — https://fr.wikisource.org/wiki/Physiologie_du_goût/Méditation_IX
    ['vin', 'Vers', 'Un soir, l\'âme du vin chantait dans les bouteilles.', 'Baudelaire'], // Les Fleurs du mal, L'Âme du vin, v. 1, 1861 — https://fr.wikisource.org/wiki/Les_Fleurs_du_mal_(1861)/L’Âme_du_vin
    ['vin', 'Vers', 'Je sais combien il faut, sur la colline en flamme,<br>De peine, de sueur et de soleil cuisant<br>Pour engendrer ma vie et pour me donner l\'âme.', 'Baudelaire'], // Les Fleurs du mal, L'Âme du vin, v. 5-7, 1861 — même page
    ['vin', 'Citation', 'Profondes joies du vin, qui ne vous a connues ?', 'Baudelaire'], // Du vin et du haschisch, I, 1851 (Les Paradis artificiels) — https://fr.wikisource.org/wiki/Les_Paradis_artificiels/Du_vin_et_du_haschisch
    ['vin', 'Vers', 'Dieu n\'avait fait que l\'eau, mais l\'homme a fait le vin !', 'Victor Hugo'], // Les Contemplations, I, 22, La Fête chez Thérèse, 1856 — https://fr.wikisource.org/wiki/Les_Contemplations/La_Fête_chez_Thérèse
    ['vin', 'Vers', 'De ce vin frais l\'écume pétillante<br>De nos Français est l\'image brillante.', 'Voltaire'], // Le Mondain, 1736 (le vin d'Aï) — https://fr.wikisource.org/wiki/Le_Mondain
    ['vin', 'Vers', 'Qu\'ils sont doux,<br>Bouteille jolie,<br>Qu\'ils sont doux<br>Vos petits glouglous !', 'Molière'], // Le Médecin malgré lui, I, 5, chanson de Sganarelle, 1666 — https://fr.wikisource.org/wiki/Le_Médecin_malgré_lui/Acte_I
    ['vin', 'Citation', 'La vigne, le vin sont de grands mystères. Seule, dans le règne végétal, la vigne nous rend intelligible ce qu\'est la véritable saveur de la terre.', 'Colette'], // Prisons et Paradis, « Vins », 1932 ; Colette, morte en 1954, est dans le domaine public depuis 2025 — https://fr.wikisource.org/wiki/Prisons_et_Paradis/Vins
    ['vin', 'Proverbe', 'À bon vin point d\'enseigne.', ''], // Littré, art. VIN — https://www.littre.org/definition/vin

    // Maison
    ['maison', 'Citation', 'Il se faut réserver une arrière-boutique toute nôtre, toute franche, en laquelle nous établissons notre vraie liberté.', 'Montaigne'], // Essais, I, 39, De la solitude, 1580 ; coupe de la fin de phrase — https://fr.wikisource.org/wiki/Essais/Livre_I/Chapitre_39
    ['maison', 'Citation', 'C\'est une absolue perfection, et comme divine, de savoir jouir loyalement de son être.', 'Montaigne'], // Essais, III, 13, De l'expérience, 1588 — https://fr.wikisource.org/wiki/Essais/Livre_III/Chapitre_13
    ['maison', 'Citation', 'Quand je danse, je danse ; quand je dors, je dors.', 'Montaigne'], // Essais, III, 13, 1588 ; la phrase continue — même page
    ['maison', 'Vers', 'Solitude, où je trouve une douceur secrète,<br>Lieux que j\'aimai toujours, ne pourrai-je jamais,<br>Loin du monde et du bruit, goûter l\'ombre et le frais !', 'La Fontaine'], // Fables, XI, 4, Le Songe d'un habitant du Mogol, 1679 — https://fr.wikisource.org/wiki/Fables_de_La_Fontaine_(éd._1874)/Le_Songe_d’un_habitant_du_Mogol
    ['maison', 'Citation', 'C\'est un excellent meuble qu\'un fauteuil ; il est surtout de la dernière utilité pour tout homme méditatif.', 'Xavier de Maistre'], // Voyage autour de ma chambre, chap. IV, 1794 — https://fr.wikisource.org/wiki/Voyage_autour_de_ma_chambre
    ['maison', 'Citation', 'Un bon feu, des livres, des plumes, que de ressources contre l\'ennui !', 'Xavier de Maistre'], // Voyage autour de ma chambre, chap. IV, 1794 — même page
    ['maison', 'Citation', 'Le plaisir qu\'on trouve à voyager dans sa chambre est à l\'abri de la jalousie inquiète des hommes ; il est indépendant de la fortune.', 'Xavier de Maistre'], // Voyage autour de ma chambre, chap. I, 1794 — même page
    ['maison', 'Aphorisme', 'Convier quelqu\'un, c\'est se charger de son bonheur pendant tout le temps qu\'il est sous notre toit.', 'Brillat-Savarin'], // Physiologie du goût, Aphorismes du professeur, XX, 1825 — https://fr.wikisource.org/wiki/Physiologie_du_goût/Aphorismes_du_professeur
    ['maison', 'Proverbe', 'À chaque oiseau son nid est beau.', ''], // Littré, art. NID — https://www.littre.org/definition/nid
    ['maison', 'Proverbe', 'Charbonnier est maître chez soi.', ''], // Littré, art. CHARBONNIER — https://www.littre.org/definition/charbonnier

    // Lecture
    ['lecture', 'Pensée', 'La lecture de tous les bons livres est comme une conversation avec les plus honnêtes gens des siècles passés, qui en ont été les auteurs.', 'Descartes'], // Discours de la méthode, 1re partie, 1637 ; la phrase continue — https://fr.wikisource.org/wiki/Discours_de_la_méthode_(éd._Cousin)/Première_partie
    ['lecture', 'Pensée', 'L\'étude a été pour moi le souverain remède contre les dégoûts de la vie, n\'ayant jamais eu de chagrin qu\'une heure de lecture ne m\'ait ôté.', 'Montesquieu'], // Pensées, Portrait par lui-même, texte du manuscrit (éd. 1899) — https://fr.wikisource.org/wiki/Pensées_et_Fragments_inédits_de_Montesquieu/I
    ['lecture', 'Citation', 'Je ne cherche aux livres qu\'à m\'y donner du plaisir par un honnête amusement.', 'Montaigne'], // Essais, II, 10, Des livres, 1580 ; la phrase continue — https://fr.wikisource.org/wiki/Essais/Livre_II/Chapitre_10
    ['lecture', 'Citation', 'Ne lisez pas, comme les enfants lisent, pour vous amuser, ni comme les ambitieux lisent, pour vous instruire. Non, lisez pour vivre.', 'Flaubert'], // Lettre à Mlle Leroyer de Chantepie, juin 1857 ; « Mais » initial retiré — https://fr.wikisource.org/wiki/Correspondance_de_Gustave_Flaubert/Tome_4/0541
    ['lecture', 'Vers', 'Ce que l\'on conçoit bien s\'énonce clairement,<br>Et les mots pour le dire arrivent aisément.', 'Boileau'], // L'Art poétique, chant I, 1674 — https://fr.wikisource.org/wiki/Boileau_-_Œuvres_poétiques/L’Art_poétique/Chant_I
    ['lecture', 'Vers', 'Hâtez-vous lentement ; et, sans perdre courage,<br>Vingt fois sur le métier remettez votre ouvrage.', 'Boileau'], // L'Art poétique, chant I, 1674 — même page
    ['lecture', 'Citation', 'Je n\'ai fait celle-ci plus longue que parce que je n\'ai pas eu le loisir de la faire plus courte.', 'Pascal'], // Les Provinciales, lettre XVI, 1656 — https://fr.wikisource.org/wiki/Les_Provinciales_(Vallée)/16
    ['lecture', 'Pensée', 'Quand on voit le style naturel, on est tout étonné, et ravi ; car on s\'attendait de voir un auteur, et on trouve un homme.', 'Pascal'], // Pensées, XXXI, éd. Desprez, 1670 — https://fr.wikisource.org/wiki/Pensées_(Pascal)/2e_éd._Desprez/XXXI
    ['lecture', 'Maxime', 'Le style est l\'homme même.', 'Buffon'], // Discours sur le style, 1753 ; début de phrase retiré — https://fr.wikisource.org/wiki/Discours_sur_le_style
    ['lecture', 'Citation', 'Il n\'y a peut-être pas de jours de notre enfance que nous ayons si pleinement vécus que ceux […] que nous avons passés avec un livre préféré.', 'Proust'], // Journées de lecture, 1905 — https://fr.wikisource.org/wiki/Journées_de_lecture
    ['lecture', 'Maxime', 'Tout est dit, et l\'on vient trop tard depuis plus de sept mille ans qu\'il y a des hommes, et qui pensent.', 'La Bruyère'], // Les Caractères, Des ouvrages de l'esprit, 1, 1688 — https://fr.wikisource.org/wiki/Les_Caractères,_édition_1872/Chapitre_1

    // Voyage
    ['voyage', 'Citation', 'Je réponds ordinairement à ceux qui me demandent raison de mes voyages : que je sais bien ce que je fuis, mais non pas ce que je cherche.', 'Montaigne'], // Essais, III, 9, De la vanité, 1588 — https://fr.wikisource.org/wiki/Essais/Livre_III/Chapitre_9
    ['voyage', 'Citation', 'Le voyager me semble un exercice profitable.', 'Montaigne'], // Essais, III, 9, 1588 ; « Outre ces raisons, » retiré — même page
    ['voyage', 'Pensée', 'C\'est quasi le même de converser avec ceux des autres siècles que de voyager.', 'Descartes'], // Discours de la méthode, 1re partie, 1637 ; « Car » initial retiré — https://fr.wikisource.org/wiki/Discours_de_la_méthode_(éd._Cousin)/Première_partie
    ['voyage', 'Citation', 'La marche a quelque chose qui anime et avive mes idées.', 'Rousseau'], // Les Confessions, livre IV, 1782 ; la phrase continue — https://fr.wikisource.org/wiki/Les_Confessions_(Rousseau)/Livre_IV
    ['voyage', 'Vers', 'Heureux qui, comme Ulysse, a fait un beau voyage…', 'Du Bellay'], // Les Regrets, sonnet XXXI, 1558 ; premier vers — https://fr.wikisource.org/wiki/Les_Regrets_(du_Bellay)
    ['voyage', 'Vers', 'Mais les vrais voyageurs sont ceux-là seuls qui partent<br>Pour partir ; cœurs légers, semblables aux ballons…', 'Baudelaire'], // Les Fleurs du mal, Le Voyage, 1861 ; la phrase continue — https://fr.wikisource.org/wiki/Les_Fleurs_du_mal_(1861)/Le_Voyage
    ['voyage', 'Vers', 'Mon enfant, ma sœur,<br>Songe à la douceur<br>D\'aller là-bas vivre ensemble !', 'Baudelaire'], // Les Fleurs du mal, L'Invitation au voyage, 1861 — https://fr.wikisource.org/wiki/Les_Fleurs_du_mal_(1861)/L’Invitation_au_voyage
    ['voyage', 'Vers', 'Qui veut voyager loin ménage sa monture.', 'Racine'], // Les Plaideurs, I, 1, 1668 — https://fr.wikisource.org/wiki/Les_Plaideurs/Barbin,_1669
    ['voyage', 'Vers', 'Amants, heureux amants, voulez-vous voyager ?<br>Que ce soit aux rives prochaines.', 'La Fontaine'], // Fables, IX, 2, Les Deux Pigeons, 1678 — https://fr.wikisource.org/wiki/Fables_de_La_Fontaine_(éd._1874)/Les_deux_Pigeons
    ['voyage', 'Citation', 'La mer est tout ! Elle couvre les sept dixièmes du globe terrestre. Son souffle est pur et sain.', 'Jules Verne'], // Vingt mille lieues sous les mers, I, 10, 1869 — https://fr.wikisource.org/wiki/Vingt_mille_lieues_sous_les_mers/Partie_1/Chapitre_10
    ['voyage', 'Vers', 'Je m\'en allais, les poings dans mes poches crevées ;<br>Mon paletot aussi devenait idéal.', 'Rimbaud'], // Ma Bohème, 1870 (éd. Vanier, 1895) — https://fr.wikisource.org/wiki/Poésies_(Rimbaud)/éd._Vanier,_1895/Ma_Bohême

    // Jardin
    ['jardin', 'Citation', 'Il faut cultiver notre jardin.', 'Voltaire'], // Candide, chap. 30, dernière phrase, 1759 ; « Cela est bien dit, répondit Candide, mais » retiré — https://fr.wikisource.org/wiki/Candide,_ou_l’Optimisme/Garnier_1877/Chapitre_30
    ['jardin', 'Vers', 'Mignonne, allons voir si la rose<br>Qui ce matin avait déclose<br>Sa robe de pourpre au soleil…', 'Ronsard'], // Odes, À Cassandre (texte éd. Vaganay, 1923) ; la strophe continue — https://fr.wikisource.org/wiki/Les_Odes_(Ronsard)/«_Mignonne,_allons_voir_si_la_rose_»
    ['jardin', 'Vers', 'Travaillez, prenez de la peine :<br>C\'est le fonds qui manque le moins.', 'La Fontaine'], // Fables, V, 9, Le Laboureur et ses enfants, 1668 — https://fr.wikisource.org/wiki/Fables_de_La_Fontaine_(éd._1874)/Le_Laboureur_et_ses_enfants
    ['jardin', 'Citation', 'Le beau est aussi utile que l\'utile.', 'Victor Hugo'], // Les Misérables, I, 1, 6 (le jardin de l'évêque), 1862 — https://fr.wikisource.org/wiki/Les_Misérables/Tome_1/Livre_1/06
    ['jardin', 'Vers', 'Je ne songeais pas à Rose ;<br>Rose au bois vint avec moi.', 'Victor Hugo'], // Les Contemplations, I, 19, Vieille chanson du jeune temps, 1856 — https://fr.wikisource.org/wiki/Les_Contemplations/Vieille_chanson_du_jeune_temps
    ['jardin', 'Citation', 'Ce billet doux plié en deux cherche une adresse de fleur.', 'Jules Renard'], // Histoires naturelles, Le Papillon, 1896 — https://fr.wikisource.org/wiki/Histoires_naturelles/ill._Rabier
    ['jardin', 'Citation', 'Cette goutte de lune dans l\'herbe !', 'Jules Renard'], // Histoires naturelles, Le Ver luisant, 1896 — même page
    ['jardin', 'Pensée', 'Les arbres, les arbrisseaux, les plantes sont la parure et le vêtement de la terre.', 'Rousseau'], // Les Rêveries du promeneur solitaire, 7e promenade, 1782 — https://fr.wikisource.org/wiki/Les_Rêveries_du_promeneur_solitaire/Septième_Promenade
    ['jardin', 'Vers', 'Par les soirs bleus d\'été, j\'irai dans les sentiers,<br>Picoté par les blés, fouler l\'herbe menue.', 'Rimbaud'], // Sensation, 1870 (éd. Vanier, 1895) — https://fr.wikisource.org/wiki/Poésies_(Rimbaud)/éd._Vanier,_1895/Sensation
    ['jardin', 'Vers', 'Voici des fruits, des fleurs, des feuilles et des branches,<br>Et puis voici mon cœur, qui ne bat que pour vous.', 'Verlaine'], // Romances sans paroles, Green, 1874 — https://fr.wikisource.org/wiki/Romances_sans_paroles_(1902)/Green

    // Amour et amitié
    ['amour', 'Pensée', 'Le cœur a ses raisons, que la raison ne connaît point.', 'Pascal'], // Pensées, XXVIII, éd. Desprez, 1670 (Brunschvicg 277) — https://fr.wikisource.org/wiki/Pensées_(Pascal)/2e_éd._Desprez/XXVIII
    ['amour', 'Citation', 'Si on me presse de dire pourquoi je l\'aimais, je sens que cela ne se peut exprimer qu\'en répondant : « Parce que c\'était lui, parce que c\'était moi. »', 'Montaigne'], // Essais, I, De l'amitié, 1580 — https://fr.wikisource.org/wiki/Essais/édition_Musart,_1847/17
    ['amour', 'Vers', 'Qu\'un ami véritable est une douce chose !', 'La Fontaine'], // Fables, VIII, 11, Les Deux Amis, 1678 — https://fr.wikisource.org/wiki/Fables_de_La_Fontaine_(éd._1874)/Les_deux_Amis
    ['amour', 'Vers', 'Vivez, si m\'en croyez, n\'attendez à demain :<br>Cueillez dès aujourd\'hui les roses de la vie.', 'Ronsard'], // Sonnets pour Hélène, II, Quand vous serez bien vieille, 1578 — https://fr.wikisource.org/wiki/Le_second_livre_des_Sonnets_pour_Hélène/Quand_vous_serez_bien_vieille
    ['amour', 'Citation', 'Le suprême bonheur de la vie, c\'est la conviction qu\'on est aimé ; aimé pour soi-même, disons mieux, aimé malgré soi-même.', 'Victor Hugo'], // Les Misérables, I, 5, 4, 1862 ; la phrase continue — https://fr.wikisource.org/wiki/Les_Misérables/Tome_1/Livre_5/04
    ['amour', 'Citation', 'Aimer ou avoir aimé, cela suffit. Ne demandez rien ensuite.', 'Victor Hugo'], // Les Misérables, V, 6, 2, 1862 — https://fr.wikisource.org/wiki/Les_Misérables/Tome_5/Livre_6/02
    ['amour', 'Citation', 'J\'ai souffert souvent, je me suis trompé quelquefois, mais j\'ai aimé.', 'Musset'], // On ne badine pas avec l'amour, II, 5 (Perdican), 1834 — https://fr.wikisource.org/wiki/On_ne_badine_pas_avec_l’amour_(1884)/Acte_II
    ['amour', 'Vers', 'Ce soir ma robe encore en est toute embaumée…<br>Respires-en sur moi l\'odorant souvenir.', 'Marceline Desbordes-Valmore'], // Les Roses de Saadi, Poésies inédites, 1860 — https://fr.wikisource.org/wiki/Poésies_inédites_(Marceline_Desbordes-Valmore)/Les_Roses_de_Saadi
    ['amour', 'Vers', 'Il le faut avouer, l\'amour est un grand maître :<br>Ce qu\'on ne fut jamais il nous enseigne à l\'être.', 'Molière'], // L'École des femmes, III, 4 (Horace), 1662 — https://fr.wikisource.org/wiki/L’École_des_femmes/Édition_Louandre,_1910/Acte_III
    ['amour', 'Maxime', 'Il n\'y a point de déguisement qui puisse longtemps cacher l\'amour où il est, ni le feindre où il n\'est pas.', 'La Rochefoucauld'], // Maximes, 70, 1665 — https://fr.wikisource.org/wiki/Œuvres_de_La_Rochefoucauld_-_T.1/Réflexions_ou_sentences_et_maximes_morales
    ['amour', 'Maxime', 'Quelque rare que soit le véritable amour, il l\'est encore moins que la véritable amitié.', 'La Rochefoucauld'], // Maximes, 473, 1678 — même page
    ['amour', 'Maxime', 'Il est plus honteux de se défier de ses amis que d\'en être trompé.', 'La Rochefoucauld'], // Maximes, 84, 1665 — même page

    // Élégance
    ['elegance', 'Citation', 'La beauté n\'est que la promesse du bonheur.', 'Stendhal'], // De l'amour, I, chap. 17 (note), 1822 — https://fr.wikisource.org/wiki/Stendhal_-_De_l’amour,_I,_1927,_éd._Martineau/Chapitre_17
    ['elegance', 'Vers', 'Le superflu, chose très nécessaire,<br>A réuni l\'un et l\'autre hémisphère.', 'Voltaire'], // Le Mondain, 1736 — https://fr.wikisource.org/wiki/Le_Mondain
    ['elegance', 'Vers', 'Rien ne manque à Vénus ; ni les lis, ni les roses, […]<br>Ni la grâce plus belle encor que la beauté.', 'La Fontaine'], // Adonis, 1658 ; deux vers omis — https://fr.wikisource.org/wiki/Adonis_(La_Fontaine)
    ['elegance', 'Citation', 'La modernité, c\'est le transitoire, le fugitif, le contingent, la moitié de l\'art, dont l\'autre moitié est l\'éternel et l\'immuable.', 'Baudelaire'], // Le Peintre de la vie moderne, IV, 1863 — https://fr.wikisource.org/wiki/L’Art_romantique/Le_Peintre_de_la_vie_moderne/IV
    ['elegance', 'Citation', 'Un philosophe se laisse habiller par son tailleur : il y a autant de faiblesse à fuir la mode qu\'à l\'affecter.', 'La Bruyère'], // Les Caractères, De la mode, 11, 1688 — https://fr.wikisource.org/wiki/Les_Caractères/De_la_mode
    ['elegance', 'Aphorisme', 'La toilette ne consiste pas tant dans le vêtement que dans une certaine manière de le porter.', 'Balzac'], // Traité de la vie élégante, XLIV, 1830 — https://fr.wikisource.org/wiki/Traité_de_la_vie_élégante/Traité_de_la_vie_élégante
    ['elegance', 'Aphorisme', 'L\'effet le plus essentiel de l\'élégance est de cacher les moyens.', 'Balzac'], // Traité de la vie élégante, XXIII, 1830 — même page
    ['elegance', 'Aphorisme', 'Dépasser la mode, c\'est devenir caricature.', 'Balzac'], // Traité de la vie élégante, L, 1830 — même page
    ['elegance', 'Maxime', 'La bonne grâce est au corps ce que le bon sens est à l\'esprit.', 'La Rochefoucauld'], // Maximes, 67, 1665 — https://fr.wikisource.org/wiki/Œuvres_de_La_Rochefoucauld_-_T.1/Réflexions_ou_sentences_et_maximes_morales
    ['elegance', 'Maxime', 'Le bon goût vient plus du jugement que de l\'esprit.', 'La Rochefoucauld'], // Maximes, 258, 1678 — même page

    // Esprit et bonne humeur
    ['esprit', 'Citation', 'Je me presse de rire de tout, de peur d\'être obligé d\'en pleurer.', 'Beaumarchais'], // Le Barbier de Séville, I, 2 (Figaro), 1775 — https://fr.wikisource.org/wiki/Le_Barbier_de_Séville/Acte_I
    ['esprit', 'Vers', 'Tout finit par des chansons.', 'Beaumarchais'], // Le Mariage de Figaro, V, vaudeville final, 1784 ; le bégaiement de Brid'oison (« fini-it ») est normalisé — https://fr.wikisource.org/wiki/Le_Mariage_de_Figaro/Acte_V
    ['esprit', 'Pensée', 'La plus perdue de toutes les journées est celle où l\'on n\'a pas ri.', 'Chamfort'], // Maximes et pensées, chap. I, 1795 — https://fr.wikisource.org/wiki/Maximes_et_Pensées_(Chamfort)/Édition_Auguis/1
    ['esprit', 'Vers', 'Mieux est de ris que de larmes écrire,<br>Pour ce que rire est le propre de l\'homme.', 'Rabelais'], // Gargantua, Aux lecteurs, 1534 — https://fr.wikisource.org/wiki/Les_Œuvres_de_François_Rabelais_(Éditions_Marty-Laveaux)/Gargantua/Aux_Lecteurs
    ['esprit', 'Vers', 'Dans ses écrits un sage italien<br>Dit que le mieux est l\'ennemi du bien.', 'Voltaire'], // La Bégueule, 1772 ; la phrase continue — https://fr.wikisource.org/wiki/Contes_en_vers_(Voltaire)/La_Bégueule
    ['esprit', 'Vers', 'Ah ! qu\'en termes galants ces choses-là sont mises !', 'Molière'], // Le Misanthrope, I, 2 (Philinte), 1666 — https://fr.wikisource.org/wiki/Le_Misanthrope/Édition_Louandre,_1910/Acte_I
    ['esprit', 'Vers', 'Rien ne sert de courir ; il faut partir à point.', 'La Fontaine'], // Fables, VI, 10, Le Lièvre et la Tortue, 1668 — https://fr.wikisource.org/wiki/Fables_de_La_Fontaine_(éd._1874)/Le_Lièvre_et_la_Tortue
    ['esprit', 'Vers', 'Il faut, autant qu\'on peut, obliger tout le monde :<br>On a souvent besoin d\'un plus petit que soi.', 'La Fontaine'], // Fables, II, 11, Le Lion et le Rat, 1668 — https://fr.wikisource.org/wiki/Fables_de_La_Fontaine_(éd._1874)/Le_Lion_et_le_Rat
    ['esprit', 'Maxime', 'C\'est une grande folie de vouloir être sage tout seul.', 'La Rochefoucauld'], // Maximes, 231, 1665 — https://fr.wikisource.org/wiki/Œuvres_de_La_Rochefoucauld_-_T.1/Réflexions_ou_sentences_et_maximes_morales
];
