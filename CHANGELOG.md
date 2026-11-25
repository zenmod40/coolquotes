# Changelog

Toutes les modifications notables de ce module sont consignées ici.

Le format suit [Keep a Changelog](https://keepachangelog.com/fr/1.1.0/) et le
versionnage respecte [SemVer](https://semver.org/lang/fr/).

## [1.0.0] - 2026-11-25

Première publication open source.

### Ajouté

- Bande de papier dépliable au clic, en bas à gauche ou en bas à droite,
  portée par un élément `<details>` natif.
- Ciblage par catégorie, avec repli sur un fonds commun affiché partout.
- Navigation entre plusieurs citations envoyées avec la page, de 1 à 20,
  huit par défaut, sans aucun appel réseau.
- Genre affiché au-dessus de chaque citation, et mot d'appel à côté du cercle
  tant que la bande est fermée.
- Gestion des citations depuis le back-office : liste filtrable par genre et
  par thème, texte multilingue, auteur, activation à l'unité ou par
  sélection (afficher ou masquer un thème entier en deux clics), arbre de
  catégories.
- Bibliothèque de 201 citations du domaine public attribuées à 61 auteurs,
  chacune référencée en commentaire dans `data/quotes.php` : un fonds zen de
  107 citations affiché dès l'installation, et 94 citations de littérature
  française en neuf thèmes (cuisine, vin, maison, lecture, voyage, jardin,
  amour, élégance, esprit), installées masquées. Les citations du thème vin
  portent la mention sanitaire de la loi Évin.
- Import et export CSV au même format, avec détection du séparateur et
  conversion des fichiers encodés par un tableur.
- Appel sonore et musique de lecture en option, désactivés par défaut,
  entièrement synthétisés avec l'API Web Audio : aucun fichier audio, aucune
  requête. Délai d'appel réglable, volume plafonné, coupure par le visiteur
  retenue d'une page à l'autre.
- Masquage dans le tunnel d'achat, actif par défaut.
- Animation de respiration périodique du cercle, arrêtée au survol et à
  l'ouverture, neutralisée par `prefers-reduced-motion`.
- Composant ZM40 Common : vérification de mise à jour et liste des autres
  modules, anonymes et désactivables d'un réglage.
