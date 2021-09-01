<?php ob_start(); ?><!-- Démarre la variable de stockage du code HTML-->

<main class="GalerieConstructeur">
  <section class="conteneurTitreGalerieConstruct">
    <h1 class="TitreGalerieConstructeur">Les Constructeurs</h1>
  </section>
  <section class="Liste">
  <?php
  foreach ($Affich as $Construc) {

    echo '<div class="imgGalerie">
            <a href="index.php?id='.$Construc['id'].'&amp;action=Constructeur"><img src="Public/'.$Construc['lienLogo'].'" alt="image de la marque'.$Construc['NomConstru'].'"></a>
            <br><h2>Nom: </h2><p>'.$Construc['NomConstru'].'</p>
          </div>';
  }
  ?>
  </section>
  <?php
    if ($NumPage>1) {
      echo '<section class="Pagination"><div>';
      for ($i=1; $i < ($NumPage+1); $i++) {
        if ($i=$_GET['page']) {
          echo '<a href="index.php?action=Galerie&page='.$i.'" class="PageActuelle">'.$i.'</a>';
        }else {
          echo '<a href="index.php?action=Galerie&page='.$i.'">'.$i.'</a>';
        }
      }
      echo '</section></div>';
    }
  ?>

</main>
<?php
$content=ob_get_clean(); //Ferme la variable de stockage du code HTML et l'envoie dans '$content'
require('View/template.php');
?>
