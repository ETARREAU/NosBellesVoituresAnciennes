<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Public/css/normalize.css">
    <link rel="stylesheet" href="Public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $title ?></title>
  </head>
  <body>
    <!-- NavBar -->
    <ul class="topnav">
      <li><a class="active" href="index.php?action=Accueil">Accueil</a></li>
      <li><a href="index.php?action=Galerie">Galerie des Voitures</a></li>
      <li><a href="index.php?action=GalerieConstructeur">Galerie des Constructeurs</a></li>
      <li class="right"><a href="ZoneAdmin/connexion.php"><i class="fa fa-user"></i></a></li>
    </ul>

      <?= $content ?>

    <footer>
      <h4><a href="#"> Mention Légal </a>/<a href="ZoneAdmin/connexion.php"> Administration </a></h4>
      <p>
         <a href="http://www.facebook.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/facebook.png"></a>
         <a href="http://www.instagram.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/instagram-new.png"></a>
         <a href="http://www.twitter.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/twitter.png"></a>
       </p>
    </footer>
    <script src="Public/js/script.js" charset="utf-8"></script>
  </body>
</html>
