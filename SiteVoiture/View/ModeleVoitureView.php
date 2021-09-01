<?php ob_start();  //Démarre la variable de stockage du code HTML

//Début de l'affichage des données récupérées par la requète
while ($LeVéhicule = $Lavoiture->fetch()){
?>

<main class="infoVoiture">

  <img src="Public/<?=$LeVéhicule['lienImg']?>" class="margeSmartPhoneImg" alt="image de la voiture <?=$LeVéhicule['NomModèle']?>">
  <h1><?=$LeVéhicule['NomModèle']?></h1>
  <h2>Marque: <a href="index.php?action=Galerie&amp;id=<?=$LeVéhicule['idConstru']?>&amp;Nom=<?=$LeVéhicule['NomConstru']?>"><?=$LeVéhicule['NomConstru']?></a></h2>
  <h2>Début de la production: <a href="index.php?action=Galerie&amp;année=<?=$LeVéhicule['Année']?>"><?=$LeVéhicule['Année']?></a></h2>

</main>

<?php
} //Fin de l'affichage des données récupérées par la requète
$content=ob_get_clean(); //Ferme la variable de stockage du code HTML et l'envoie dans '$content'
require('View/template.php');
?>
