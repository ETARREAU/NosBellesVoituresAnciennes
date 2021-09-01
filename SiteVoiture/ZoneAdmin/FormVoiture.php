<?php
require('../general/model.php');
session_start();//Démarrage de la Session

$test=VerifAutorisationPage();
$privilege=Privilege();
$id=$_GET['idV'];

if (isset($_POST['submit'])) {
  $MajOuAjou=VerifMajOUAjout();
  $msg=FormulVoiture($MajOuAjou);
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
<?php if (!empty($id)): ?>

  <!-- MODIFICATION-->
    <form class="AjoutModif" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" method="post">
      <fieldset>
          <legend>Formulaire de Modification d'une voiture</legend>
              <p>
              <?php foreach ($LaVoiture as $voiture): ?>
                <input type="hidden" name="update" value="update">
                <input type="hidden" name="id" value="<?=$voiture['id']?>">
                <label for="selecteurConstru">Nom Du Constructeur</label>
                <select class="selecteurConstru" name="selecteurConstru">
                  <?php
                    foreach ($ListConstru as $SelectConstruct) {
                      if ($voiture['idConstru']==$SelectConstruct['id']) {
                        echo  '<option value="'.$SelectConstruct['id'].'" selected>'.$SelectConstruct['NomConstru'].'</option>';
                      }else {
                        echo  '<option value="'.$SelectConstruct['id'].'">'.$SelectConstruct['NomConstru'].'</option>';
                      }
                    }
                  ?>
                </select>
                <label for="NomVoiture">Nom Du Modèle</label>
                <input type="text" name="NomVoiture" value="<?=$voiture['NomModèle']?>" required>
                <label for="AnnéeVoiture">Année de mise en Circulation</label>
                <input type="number" name="AnnéeVoiture" value="<?=$voiture['Année']?>" required>
                <input type="submit" name="submit" value="Enregistrer la/les modification" />
              <?php endforeach; ?>
              </p>
      </fieldset>
    </form>

<?php else: ?>

  <!-- AJOUT-->
    <form class="AjoutModif margeSmartPhone" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" method="post">
      <fieldset>
        <legend>Formulaire d'ajout d'une voiture</legend>
            <p>
              <label for="imgVoiture" title="Recherchez fichier du logo !" >Ajouter une image (jpg, jpeg, png)</label>
              <input name="imgVoiture" type="file" required>
              <?php echo $msg.'<br><br>';?>
              <label for="selecteurConstru">Nom Du Constructeur</label>
              <select class="selecteurConstru" name="selecteurConstru">
                <?php
                    foreach ($ListConstru as $SelectConstruct) {
                      echo  '<option value="'.$SelectConstruct['id'].'">'.$SelectConstruct['NomConstru'].'</option>';
                    }
                ?>
              </select>
              <label for="NomVoiture">Nom Du Modèle</label>
              <input type="text" name="NomVoiture" value="" required>
              <label for="AnnéeVoiture">Année de mise en Circulation</label>
              <input type="number" name="AnnéeVoiture" value="" required>
              <input type="submit" name="submit" value="Ajouter Une Voiture !">
            </p>
      </fieldset>
    </form>

<?php endif;?>

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
