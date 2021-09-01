<?php ob_start(); ?><!-- Démarre la variable de stockage du code HTML-->
<main class="GalerieVoiture ">

  <h1 class="GalerieVoitureTitre margeSmartPhone"><span class="GA">GA</span><span class="LE">LE</span><span class="RI">RI</span><span class="E">e</span></h1>
  <p><small><?=$SousTitre?></small></p>

  <section class="GalerieVoitureConteneur">
    <?php
    foreach ($MethodeAff as $Voiture) {

      echo '<div class="imgGalerie">
              <a href="index.php?id='.$Voiture['id'].'&amp;action=ModeleVoiture"><img src="Public/'.$Voiture['lienImg'].'" alt="image de la voiture'.$Voiture['NomModèle'].'"></a>
              <br><h2>Nom: </h2><p>'.$Voiture['NomModèle'].'</p>
              <h2>Date de Création: </h2><p>'.$Voiture['Année'].'</p>
            </div>';
    }
    ?>
  </section>
  <br>
    <?php
    if ($NumPage>2){
      echo '<section class="Pagination"><div>';
      for ($i=1; $i < ($NumPage+1); $i++) {
        echo '<a href="index.php?action=Galerie&page='.$i.'">'.$i.'</a>';
      }
      echo '</section></div>';
    }
     ?>
</main>
<?php
$content=ob_get_clean(); //Ferme la variable de stockage du code HTML et l'envoie dans '$content'
require('View/template.php');
?>
