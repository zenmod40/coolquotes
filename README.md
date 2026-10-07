# CoolQuotes

[![PrestaShop](https://img.shields.io/badge/PrestaShop-1.7%20%7C%208%20%7C%209-blue)](https://www.prestashop.com/)
[![Licence](https://img.shields.io/badge/licence-OSL--3.0-green)](LICENSE)

Une citation qui se déplie au clic, dans un coin de vos pages.

Un cercle discret attend en bas de l'écran. Le visiteur le touche, une bande de
papier se déplie et présente une citation ; des flèches permettent d'en lire
d'autres. Rien ne s'ouvre tout seul, rien ne s'affiche pendant la commande.

## Fonctionnalités

- Bande de papier dépliable, en bas à gauche ou en bas à droite, avec un voile
  qui efface le reste de la page pendant la lecture. On ferme par la croix, par
  un clic à côté, par la touche Échap ou par le cercle.
- Ciblage par catégorie : une citation peut être réservée à certaines
  catégories, et aux produits qui y sont rangés. Sans sélection, elle rejoint
  le fonds commun affiché partout.
- Plusieurs citations envoyées par page — huit par défaut, réglable de 1 à 20 —
  et une navigation par flèches avec compteur. Aucun appel réseau.
- Genre affiché au-dessus de chaque citation : haïku, maxime, proverbe,
  précepte, ce que vous voulez.
- Gestion complète depuis le back-office : liste filtrable, texte multilingue,
  auteur, genre, thème interne, activation à l'unité.
- Import et export CSV, dans le même format : on exporte, on modifie dans un
  tableur, on réimporte.
- Appel sonore et musique de lecture, en option et désactivés par défaut. Tout
  est synthétisé dans le navigateur : aucun fichier audio, aucune requête.
- Jamais affiché dans le tunnel d'achat, par défaut.
- Ouverture au clic. L'ouverture automatique existe en option, désactivée.
- Aucune dépendance : pas de librairie JavaScript, pas de police distante. Le
  cercle est un SVG en ligne, le script fait vingt-trois lignes.
- Accessible : l'ouverture repose sur un élément `<details>` natif, donc
  utilisable au clavier et fonctionnel sans JavaScript. Les animations
  respectent `prefers-reduced-motion`.

## La bibliothèque livrée

Le module installe 109 citations, réparties en sept genres et attribuées à
27 auteurs : haïkus de Bashō, Issa, Buson, Ryōkan, Chiyo-ni et Shiki ; textes
zen de Dōgen, Sengcan, Huineng et Wumen ; versets du Dhammapada ; classiques
chinois de Confucius, Laozi, Zhuangzi, Mencius, Xunzi et Sun Tzu ; préceptes
de Miyamoto Musashi, Yagyū Munenori et Takuan Sōhō ; règles de thé de Sen no
Rikyū ; paroles de Kabir, Ramakrishna, Vivekananda, Sri Aurobindo et Shirdi
Sai Baba ; écrits de Gandhi ; proverbes chinois et japonais.

Deux règles ont présidé à cette sélection, et elles valent aussi pour toute
contribution.

**Rien d'inventé.** Chaque entrée renvoie à un texte réel, dont la référence
figure en commentaire dans `data/quotes.php`. Les traductions françaises sont
originales, faites pour ce module.

**Rien sous droits.** Tous les auteurs retenus sont dans le domaine public.
Des auteurs plus récents, ou vivants, sont encore protégés et ne peuvent pas
être redistribués ici — rien n'empêche un marchand de les saisir lui-même
depuis le back-office pour sa propre boutique.

## Compatibilité

PrestaShop 1.7, 8 et 9. PHP 7.1 et supérieur. Une version pour ThirtyBees et
PrestaShop 1.6 peut être fournie sur demande.

## Installation

Depuis le back-office, Modules puis Téléverser un module, en choisissant le
fichier `coolquotes.zip`. Ou en déposant le dossier `coolquotes/` dans le
répertoire `modules/` de votre boutique, puis en l'installant depuis la liste.

## Configuration

Le module s'ouvre sur ses réglages : activation, coin d'affichage, texte du
bouton, mot d'appel, nombre de citations envoyées par page, ouverture
automatique, masquage dans le tunnel d'achat, conservation des données à la
désinstallation.

Le bouton Gérer les citations mène à la bibliothèque, où chaque citation se
modifie, se désactive ou se cible par catégorie.

### Le son

Deux options, désactivées par défaut, parce qu'un son sur une boutique est une
intrusion que le marchand doit décider.

**L'appel** frappe un bol tibétain, une fois, pour inviter à lire. Les
navigateurs interdisant tout son avant un geste du visiteur, le compte à
rebours démarre à sa première interaction avec la page — pas au chargement.
Le délai se règle de 10 à 600 secondes, 90 par défaut, et l'appel ne sonne
qu'une fois par visite, pas à chaque page. Il est passé si la bande est déjà
ouverte, si l'onglet est en arrière-plan, ou si le visiteur a coupé le son.

**La musique** accompagne la lecture tant que la bande reste ouverte : un
bourdon et quelques notes pentatoniques espacées au hasard. Un bouton sur la
bande coupe le son, et ce choix est retenu d'une page à l'autre.

Rien de tout cela n'est un fichier. Le son est synthétisé avec l'API Web Audio
— quelques oscillateurs et des enveloppes — donc le module ne charge aucun
MP3, n'émet aucune requête et ne traîne aucune licence de sample. Le volume se
règle de 0 à 100, et le module plafonne de toute façon à la moitié du volume
du navigateur.

### Import et export CSV

La bibliothèque s'importe et s'exporte au format CSV, depuis le panneau posé
au-dessus de la liste. Les deux directions parlent le même format, donc un
export modifié dans un tableur se réimporte tel quel.

Colonnes reconnues : `theme`, `kind`, `text`, `author`, `categories`, `active`.
Une ligne d'en-tête est obligatoire, mais l'ordre des colonnes est libre et
celles qui ne sont pas reconnues sont ignorées. Seule `text` doit être
renseignée : une ligne sans texte est passée. Le séparateur, point-virgule ou
virgule, est détecté sur la ligne d'en-tête, et un fichier encodé en
Windows-1252 par un tableur est converti à la volée.

`categories` contient des identifiants de catégorie séparés par des virgules ;
`active` vaut 0 ou 1, et 1 par défaut.

Chaque ligne crée une citation : l'import n'écrase jamais l'existant et ne
supprime rien. Le texte importé est appliqué à toutes les langues de la
boutique — pour un contenu propre à chaque langue, passez par le formulaire.

Toutes les couleurs du module sont des variables CSS regroupées en tête de
`views/css/coolquotes.css`. Pour l'adapter à votre thème, redéfinissez
`--cq-paper`, `--cq-ink`, `--cq-line` et `--cq-accent` depuis votre feuille de
style personnalisée : aucune modification du module n'est nécessaire.

## Confidentialité

Le module interroge zm40.com pour deux choses seulement : savoir si une
nouvelle version est disponible, et afficher la liste des autres modules ZM40
sur la page de configuration. Ces appels sont anonymes, mis en cache
vingt-quatre heures, et n'emportent aucune donnée de votre boutique, de vos
clients ou de vos commandes. Ils échouent en silence si le réseau est coupé.

Le réglage « Vérifier les mises à jour et actualiser la liste des modules
ZM40 », dans l'onglet Modules ZM40, les désactive entièrement ; la liste déjà
reçue reste alors affichée telle quelle.

Côté visiteur, le module ne dépose aucun cookie, ne charge aucune ressource
externe et ne mesure rien.

## Support et prestations

Les signalements de bogue et les demandes d'évolution passent par les issues
du dépôt. Voir [SUPPORT.md](SUPPORT.md).

ZM40 propose par ailleurs des prestations sur devis : installation et
configuration, adaptation à votre thème, développements sur mesure, reprise
de modules existants, maintenance. Voir [zm40.com](https://zm40.com/).

## Contribuer

Les correctifs et les propositions sont les bienvenus. Pour une contribution
au contenu, les deux règles ci-dessus s'appliquent sans exception : le texte
doit être réel, sourcé en commentaire, et libre de droits.

## Licence

Open Software License 3.0. Voir [LICENSE](LICENSE).

PrestaShop étant lui-même publié sous OSL-3.0, un module ne peut pas être
distribué sous GPL sans créer une incompatibilité de licences.
