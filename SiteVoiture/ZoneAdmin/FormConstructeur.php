<?php
require('../general/model.php');

session_start();//Démarrage de la Session

VerifAutorisationPage();
$privilege=Privilege();
PasDeModérateur($privilege);

if (isset($_POST['submit'])) {
  $MajOuAjou=VerifMajOUAjout();
  $msg=FormulConstru($MajOuAjou);
}

$LeConstructeur=LeConstructeur($_GET['idC']);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Public/css/normalize.css">
    <link rel="stylesheet" href="../Public/css/style.css">
    <title>Constructeur</title>
  </head>
  <body>
  <header>

      <!-- NavBar -->
      <ul class="topnav">
        <li class="right"><a href="AdministrationSite.php">Retour</a></li>
      </ul>
      <!-- ######## -->

  </header>
  <main>

<?php
if (!empty($_GET['idC'])):
?>
  <!-- Début du formulaire de modification d'un constructeur-->
  <form class="AjoutModif margeSmartPhone" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" method="post">
    <fieldset>
      <?php foreach ($LeConstructeur as $Cons): ?>
        <legend>Formulaire de modification de la marque <?=$Cons['NomConstru']?></legend>
          <p>
            <input type="hidden" name="id" value="<?=$Cons['id']?>"/>
            <input type="hidden" name="update" value="update"/>
            <label for="NomConstructeur">Nom Du Constructeur</label>
            <input type="text" name="NomConstructeur" value="<?=$Cons['NomConstru']?>" required>
            <label for="Description">Résumé</label>
            <input type="text" name="Description" value="<?=$Cons['description']?>" required>
            <label for="Biographie">Description</label>
            <textarea cols="4" rows="8" name="Biographie" required><?=$Cons['bio']?></textarea>
            <input type="submit" name="submit" value="Enregistrer la/les modification" />
          </p>
      <?php endforeach; ?>
    </fieldset>
  </form>

<?php else : ?>

  <!-- Début du formulaire d'ajout d'un constructeur-->
  <form class="AjoutModif" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" method="post">
    <fieldset>
      <legend>Formulaire d'ajout d'un constructeur</legend>
        <p>
          <label for="imgConstru" title="Recherchez fichier du logo !">Ajouter une image (jpg, jpeg, png)</label>
          <input name="imgConstru" type="file" required/>
          <?php echo $msg.'<br><br>';?>
          <label for="NomConstructeur">Nom Du Constructeur</label>
          <input type="text" name="NomConstructeur" value="" required>
          <label for="Description">Résumé</label>
          <input type="text" name="Description" value="" required>
          <label for="Biographie">Description</label>
          <input type="textarea" rows="5" cols="33" name="Biographie" value="" required>
          <input type="submit" name="submit" value="Ajouter un constructeur!"/>
        </p>
    </fieldset>
  </form>

<?php endif; ?>

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
