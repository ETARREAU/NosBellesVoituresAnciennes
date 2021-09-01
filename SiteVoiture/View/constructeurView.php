<?php ob_start(); ?><!-- Démarre la variable de stockage du code HTML-->

<?php

//Début de l'affichage des données récupérées par la requète
while ($LeConstructeur = $LeConstructe->fetch()){

?>

<main>

   <div class="container">
     <blockquote>
       <strong>Présentation</strong> d'un <em>&nbsp<span>Constructeur</span></em> <strong>&nbsp&nbsp&nbsp&nbspmémorable</strong>
     </blockquote>
     <b>La Marque <?=$LeConstructeur['NomConstru'];?></b>
   </div>

    <div class="ConstructeurDescription">
      <img src="Public/<?=$LeConstructeur['lienLogo']?>" alt="logo de <?=$LeConstructeur['NomConstru']?>">
      <h1>Présentation: </h1><br><p><?=$LeConstructeur['bio'];?></p>
      <a href="index.php?id=<?=$LeConstructeur['id'];?>&amp;action=Galerie&amp;Nom=<?=$LeConstructeur['NomConstru']?>">Voir les voitures de la marque</a>
    </div>

</main>

<?php
} //Fin de l'affichage des données récupérées par la requète

$content=ob_get_clean(); //Ferme la variable de stockage du code HTML et l'envoie dans $content
require('View/template.php');
?>
