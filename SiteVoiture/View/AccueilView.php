<?php ob_start(); ?><!-- Démarre la variable de stockage du code HTML-->


    <!-- Titre -->
    <div class="paralax1 margeSmartPhone">
      <div class="paralax-inner LeTitre">
          <h1>Nos  &nbspBelles<br>&nbspVoitures Anciennes...</h1>
      </div>
    </div>

<!--
------------------------------------------ /////////////////// --------------------------------------------
-->

  <div class="margin">
    <div class="presentation">
      <h2>Présentation :</h2>
      <p>
         Dans   les   années   30   et   40,   les   constructeurs   automobiles   français   allièrent   à
         l’aérodynamisme de la carrosserie, l'esthétisme stylistique.<br><br>
         Au cours d'une trentaine d’années on était passé de la voiture à caisse carrée, dérivée du fiacre ou de la calèche,
         aux somptueuses carrosseries aux courbes et galbes voluptueux.<br><br>
         L'élan dynamique et affiné des lignes se mariait à l'ondoiement et aux volutes des ailes, capots,habitacles et coffres.
         Dès  lors,  Les  profils  s'étirent  en  mouvance  féminine,  les  proues, parées  de chromes, s'élargissent et
         se virilisent avec cette retenue tout à fait remarquable dans l’agressivité, les poupes s'abaissent et s’allongent,
         la ligne de fuite veut que l'auto colle à la route.
      </p>
    </div>
  </div>

<!--
------------------------------------------ /////////////////// --------------------------------------------
-->

  <div class="paralax2">
    <div class="paralax-inner">

        <div class="backgroundTitleCarousel">
          <h2 class="NewsTitle">Les Jolies Trouvailles</h2>
        </div>

    </div>
  </div>

<!--
------------------------------------------ /////////////////// --------------------------------------------
-->

  <div class="margin News">
      <h3>" Nos 3 derniers ajouts "</h3>

    <!-- Le carousel qui affiche les 3 derniers modèles de voitures insérés -->
        <div class="slideshow-container">

      <!-- Chargement des 3 dernières Images insérées dans la base dans les éléments du Carousel -->
          <?php
            $conteur=1;

            foreach ($TroisDerniereEntree as $TroisEntree) {
              echo '<div class="mySlides fade">
              <br><div class="numbertext">'.$conteur.'/ 3</div>
              <br><img src="Public/'.$TroisEntree['lienImg'].'" alt="Image '.$TroisEntree['NomModèle'].'">
              <br><div class="text">'.$TroisEntree['NomModèle'].'</div>
              <br></div>';
              $conteur++;
            }
          ?>

      <!-- Boutons avant / Arrière -->
          <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
          <a class="next" onclick="plusSlides(1)">&#10095;</a>

    </div>
  </div>

<!--
------------------------------------------ /////////////////// --------------------------------------------
-->

  <div class="paralax3">
    <div class="paralax-inner">
        <h2 class="lesConstructeursTitle">Un de ces Fameux Constructeurs</h2>
    </div>
  </div>

<!--
------------------------------------------ /////////////////// --------------------------------------------
-->

  <div class="marginBas ConstructeurAléa">
        <?php
        //Affiche le constructeur aléatoire
          foreach ($ConstructAleatoire as $ConstructAleatoire) {
            echo '<h3>'.$ConstructAleatoire['NomConstru'].'</h3><p>'.$ConstructAleatoire['description'].'</p><br><br><a href="index.php?id='.$ConstructAleatoire['id'].'&amp;action=Constructeur">En savoir plus</a>';
          }
        ?>
  </div>

<!--
------------------------------------------ /////////////////// --------------------------------------------
-->

<?php
$content=ob_get_clean();//Ferme la variable de stockage du code HTML et l'envoie dans $content
require('View/template.php');
?>
