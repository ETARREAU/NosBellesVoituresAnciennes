<?php
require('../general/model.php');

  // Test de l'envoi du formulaire
    if(isset($_POST['submit']))
    {
        // Requètes pour récupérer les infos des comptes dans la base de donnée
          $login=htmlspecialchars($_POST['login']);
          $password=htmlspecialchars($_POST['password']);
          $LaConnection=BDD_Utilisateur($login);

          if($LaConnection->rowCount()==1) {
            foreach ($LaConnection as $value) {
              $hash=$value['mdp'];
            }

                //Vérification de la concordance des mot de passe.
                if (password_verify($password,$hash)) {

                  session_start();  // On ouvre la session

                  // on applique les infos en tant que variables de session
                  $_SESSION['login'] = $login;
                  $_SESSION['mdp'] = $password;

                  header('Location:AdministrationSite.php');  // On redirige vers la page Principale de la zone d'admnistration

                } else {
                  $errorMessage = 'Mot de passe incorrect !';
                }

          } else {
            $errorMessage = 'Identifiant incorrect !';
          }
    }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../Public/css/normalize.css">
    <link rel="stylesheet" href="../Public/css/style.css">
    <title>Connexion</title>
  </head>
  <body>

    <!-- NavBar -->
    <ul class="topnav">
      <li><a class="active" href="../index.php">Retour à l'Accueil</a></li>
    </ul>
    <!-- ######## -->

    <main class="connexionAdmin">
            <!-- Formulaire pour se connecter -->
      <form action="<?php echo htmlspecialchars($_SERVER[PHP_SELF]); ?>" method="post">
        <fieldset>
          <legend>Identifiez-vous</legend>
          <?php
            // Rencontre-t-on une erreur lors de la tentative de connexion ?
            if(!empty($errorMessage))
            {
              echo '<p>', htmlspecialchars($errorMessage) ,'</p>';
            }
          ?>
          <p>
            <label for="login">Identifiant :</label>
            <input type="text" name="login" id="login" value="" required/>
          </p>
          <p>
            <label for="password">Mot De Passe :</label>
            <input type="password" name="password" id="password" value="" required/>
          </p>
          <input type="submit" class="ConnectionBouton" name="submit" value="Se Connecter" />
        </fieldset>
      </form>
    </main>

    <footer>
      <footer>
        <h4><a href="constructeur.php?id=1"> Mention Légal </a>/<a href="ZoneAdmin/connexion.php"> Administration </a></h4>
        <p>
           <a href="http://www.facebook.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/facebook.png"></a>
           <a href="http://www.instagram.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/instagram-new.png"></a>
           <a href="http://www.twitter.com"><img class="liensréseault" src="https://img.icons8.com/carbon-copy/100/000000/twitter.png"></a>
         </p>
      </footer>

  <script src="../Public/js" charset="utf-8"></script>
  </script>
  </body>
</html>
