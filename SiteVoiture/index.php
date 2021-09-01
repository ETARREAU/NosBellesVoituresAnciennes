<?php
require('Controller/Controlleur.php');


switch ($_GET['action']) {

// PAGE ACCUEIL
    case 'Accueil':
      Accueil();
      break;

// PAGE GALERIE
    case 'Galerie':
      Galerie();
      break;


// PAGE INFOS UNE SEUL VOITURE
    case 'ModeleVoiture':
      ModeleVoiture();
      break;

// PAGE GALERIE CONSTRUCTEUR
    case 'GalerieConstructeur':
      GalerieConstruct();
      break;

// PAGE DU CONSTRUCTEUR
    case 'Constructeur':
      Constructeur();
      break;


  default:
    Accueil();
    break;
}

 ?>
