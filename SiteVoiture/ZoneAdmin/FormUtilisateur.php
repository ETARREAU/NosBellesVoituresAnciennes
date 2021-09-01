<?php
require('../general/model.php');

session_start();//Démarrage de la Session

$test=VerifAutorisationPage();
$privilege=Privilege();
$test2=PasDeModérateur($privilege);

if (isset($_POST['submit'])) {
 FormulUtilisateur();
}

$LaVoiture=LeVehicule($_GET['idV']);
$ListConstru=ToutLesConstructeurs();

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Public/css/normalize.css">
    <link rel="stylesheet" href="../Public/css/style.css">
    <title>Voiture</title>
  </head>
  <body>
  <header>

    <!-- NavBar -->
    <ul class="topnav">
      <li class="right"><a href="AdministrationSite.php">Retour</a></li>
    </ul>

  </header>
  <main>
    <!-- ######## -->

  <!-- AJOUT-->
    <form class="AjoutModif margeSmartPhone" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" method="post">
      <fieldset>
        <legend>Formulaire d'ajout d'un utilisateur</legend>
        <p>
          <label for="login">Identifiant :</label>
          <input type="text" name="pseudo" id="login" value="" required/>
          <label for="password">Mot De Passe :</label>
          <input type="password" name="mdp" id="password" value="" required/>
          <label for="pouvoir">Pouvoir :</label>
          <select name="pouvoir" class="pouvoir">
              <option value="1">Modérateur</option>
              <option value="2">Administrateur</option>
          </select>
          <input type="submit" name="submit" value="Enregistrer la/les modification">
        </p>
      </fieldset>
    </form>


  </main>
  <footer>
    <h4><a href="#"> Mention Légal </a>/<a href="ZoneAdmin/AdministrationSite.php"> Administration </a></h4>
    <p>
       <a href="http://www.facebook.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/facebook.png"></a>
       <a href="http://www.instagram.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/instagram-new.png"></a>
       <a href="http://www.twitter.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/twitter.png"></a>
     </p>
  </footer>

  <script src="../Public/js" charset="utf-8"></script>
  </body>
</html>
