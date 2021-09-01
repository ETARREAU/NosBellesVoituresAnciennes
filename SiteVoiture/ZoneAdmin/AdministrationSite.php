<?php
require('../general/model.php');

session_start();


$test=VerifAutorisationPage();
$privilege=Privilege();


//Supression de l'élément voulu
if (isset($_GET['Supprim'])) {
  $id=$_GET['id'];

  if ($_GET['Supprim']=='V') {
    SupprimVoiture($id);
  }
   if ($privilege==1) {
    if ($_GET['Supprim']=='U') {
      SupprimUtilisateur($id);
    } else if ($_GET['Supprim']=='C') {
      SupprimConstructeur($id);
    }
  }
}

$ListConstru=ToutLesConstructeurs();
$ListVoiture=ToutesLesVoitures();
$ListUtilisateurs=ToutLesUtilisateurs();

if (isset($_GET['SesDestruc'])) {
  session_destroy();
  header('Location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Public/css/normalize.css">
    <link rel="stylesheet" href="../Public/css/style.css">
    <title>Administration</title>
  </head>
  <body>

    <!-- NavBar -->
    <ul class="topnav">
      <li class="right"><a href="AdministrationSite.php?SesDestruc=1">Déconnexion</a></li>
    </ul>
    <!-- ######## -->

    <main class="AccueilAdmin">
      <h1>Administration</h1>
      <?php  echo$Liensimg;?>
      <div class="ListeAdmin">

        <div class="AdminMarques">

         <!-- Affichage des Marques Enregistrées-->
         <h2>Les Marques Enregistrées:</h2>
           <p>
             <?php
             foreach ($ListConstru as $constructeur) {
               if ($privilege==1) {
                 echo $constructeur['NomConstru'].'
                <br><a class="BTupdtdel" href="FormConstructeur.php?idC='.$constructeur['id'].'"> Mettre à jour </a> //  <a class="BTupdtdel" onclick="return(confirm(\'ATTENTION ! Cela entrainera aussi la suppression de tout les vehicules lié à la marque ! Êtes-vous sûr de vouloir supprimer ce constructeur ? \'));" href="AdministrationSite.php?Supprim=C&amp;id='.$constructeur['id'].'"> Supprimer </a>
                <br><hr><br>';
               } else {
                  echo $constructeur['NomConstru'].'<br><br><hr><br><br>';
                  }
             }
             ?>
          </p>
           <!-- Bouton pour ajouter une marque-->
          <br>
          <?php if ($privilege==1): ?>
             <a class="AdminBouton" href="FormConstructeur.php"> Ajouter une Marque </a>
          <?php endif; ?>
          <br>

        </div>
        <div class="AdminVoiture">

          <!-- Affichage des Modèles de Voitures Enregistrées-->
          <h2>Les Voitures par Marques</h2>
          <p>
            <?php
            foreach ($ListVoiture as $voiture) {
               if ($privilege==1 || $privilege==0) {
                echo $voiture['NomModèle'].'
                <br><a class="BTupdtdel" href="FormVoiture.php?idV='.$voiture['id'].'"> Mettre à jour </a> // <a class="BTupdtdel" onclick="return(confirm(\'Êtes-vous sûr de vouloir supprimer ce véhicule ?\'));" href="AdministrationSite.php?Supprim=V&amp;id='.$voiture['id'].'"> Supprimer </a>
                <br><hr><br>';
              } else {
                 echo $voiture['NomModèle'].'<br><br><hr><br><br>';
              }
            }
            ?>
           </p>
           <!-- Bouton pour ajouter une voiture -->
           <br>
           <?php
             if ($privilege==1 || $privilege==0) {
               echo '<a class="AdminBouton" href="FormVoiture.php"> Ajouter une Voiture </a>';
             }
           ?>
           <br>
        </div>
        <div class="AdminUtilisateurs">
          <!-- Affichage des Utilisateurs Enregistrées -->
          <h2 >Les Utilisateurs</h2>
          <p>
            <?php
            foreach ($ListUtilisateurs as $utilisateurs) {
              if ($privilege==1) {
                if ($utilisateurs['pouvoir']==2) {
                  echo $utilisateurs['pseudo'].'<br><br><hr><br>';
                }else {
                  echo $utilisateurs['pseudo'].'<br>
                  <a class="BTupdtdel" onclick="return(confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\'));" href="AdministrationSite.php?Supprim=U&amp;id='.$utilisateurs['id'].'"> Supprimer </a>
                  <br><hr><br>';
                }
              }else {
                echo $utilisateurs['pseudo'].'<br><br><hr><br>';
              }
            }
            ?>
          </p>
          <br>
          <?php
            if ($privilege==1) {
              echo '<a class="AdminBouton" href="FormUtilisateur.php"> Ajouter un Utilisateur </a>';
            }
          ?>
          <br>
        </div>

      </div>
    </main>
    <footer>
      <h4><a href="#"> Mention Légal </a>/<a href="#"> Administration </a></h4>
      <p>
         <a href="http://www.facebook.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/facebook.png"></a>
         <a href="http://www.instagram.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/instagram-new.png"></a>
         <a href="http://www.twitter.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/twitter.png"></a>
       </p>
    </footer>

    <script src="../Public/js" charset="utf-8"></script>
  </body>
</html>
