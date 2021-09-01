<?php
require('general/model.php');

function Accueil()
{
  $title='Bienvenue';
  $TroisDerniereEntree=TroisDernieresEntrees();
  $ConstructAleatoire=ConstructeurAleatoire();
  require('View/AccueilView.php');
}

function Constructeur()
{
  $title='Le Constructeur';

  $id=VerificationLien($_GET['id']);
  $LeConstructe = LeConstructeur($id);

  require('View/constructeurView.php');
}

function Galerie()
{

  $title='Galerie des véhicules';

  $afficher = CheckLien();

  $SousTitre = SelectionMessage($afficher);
  $MethodeAff= PaginationVehichule($_GET['page'], $afficher);
  $NumPage=PageNumero($afficher);


  require('View/GalerieVoitureView.php');
}


function GalerieConstruct(){

  $title='Galerie des Constructeurs';

  $Affich=AffichConstruct();

  require('View/GalerieConstructeurView.php');
}


function ModeleVoiture()
{
  $title='Voiture';

  $Lavoiture=LeVehicule($_GET['id']);

  require('View/ModeleVoitureView.php');
}
?>
