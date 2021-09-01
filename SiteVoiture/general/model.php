<?php
//initie la connection à la BDD Voiture.

function Connexion()
{
  require 'AccesZoneProteger/InfosConnection.php';


  try {
      $bdd = new PDO('mysql:host='.$host.';dbname='.$LaBasedd,$user,$pass, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $bdd->exec("SET CHARACTER SET utf8");
  }
  catch(Exception $e){echo'Erreur : '. $e->getMessage().'<br/>';echo'N°: '. $e->getCode();}

  return $bdd;
}

//Récupère tout les véhicules dans la BDD
function ToutesLesVoitures()
{
  $db=Connexion();

  $List = $db->prepare("SELECT * FROM vehicule ORDER BY idConstru");
  $List->execute();

  return $List;
}

//Récupère tout les constructeur dans la BDD
function ToutLesConstructeurs()
{
  $db=Connexion();

  $List = $db->prepare("SELECT * FROM constructeurAuto");
  $List->execute();

  return $List;
}

//Récupère les trois dernières entrées dans la BDD
function TroisDernieresEntrees()
{
  $db=Connexion();

  $List = $db->prepare("SELECT * FROM vehicule ORDER BY id DESC LIMIT 3");
  $List->execute();

  return $List;
}

//Récupération d'un véhicule dans la BDD avec l'id
function LeVehicule($récup)
{
  $db=Connexion();

  $LaVoiture = $db->prepare("SELECT vehicule.*,constructeurAuto.NomConstru FROM vehicule INNER JOIN constructeurAuto ON vehicule.idConstru=constructeurAuto.id WHERE vehicule.id=?");
  $LaVoiture->bindParam(1, $récup, PDO::PARAM_INT);
  $LaVoiture->execute();

  return $LaVoiture;
}

//Récupération d'un constructeur dans la BDD avec l'id
function LeConstructeur($Leid)
{
  $db=Connexion();

  $Liste = $db->prepare("SELECT * FROM constructeurAuto WHERE id = ?");
  $Liste->bindParam(1, $Leid, PDO::PARAM_INT);
  $Liste->execute();

  return $Liste;
}

//Récupère un constructeur aléatoire dans la BDD
function ConstructeurAleatoire()
{
  $db=Connexion();

  $List = $db->prepare("SELECT * FROM constructeurAuto ORDER BY rand() LIMIT 1");
  $List->execute();

  return $List;
}

//Ramène l'utilisateur dans la BDD correspondant au $login et $password
function BDD_Utilisateur($login)
{
  $db=Connexion();

  /*Requète pour récupérer les infos du compte*/
  $LaConnection = $db->prepare("SELECT * FROM utilisateurs WHERE pseudo=?");
  $LaConnection->bindParam(1, $login, PDO::PARAM_STR);
  $LaConnection->execute();
    return $LaConnection;
}

function ToutLesUtilisateurs()
{
  $db=Connexion();

  /*Requète pour récupérer les infos du compte*/
  $LaConnection = $db->prepare("SELECT * FROM utilisateurs ORDER BY id");
  $LaConnection->execute(array());

  return $LaConnection;
}

// Attribue une valeur à $test en fonction de ce qui est récupéré en $_GET
function CheckLien()
{
  if (isset($_GET['année']) AND !empty($_GET['année'])) {
      $test=1;
    } else if (isset($_GET['id']) AND !empty($_GET['id'])){
        $test=2;
        }
  return $test;
}

// Selection de le message dessous le titre, suivant l'information récupéré en $test
function SelectionMessage($test)
{
  if ($test==1) {
  $info='Véhicules de l\'année '.intval($_GET['année']);
    } else if ($test==2){
          $info='Véhicules de la marque '.intval($_GET['Nom']);
        } else {
              $info='Tout les véhicules présents dans la base de donnée';
            }
  return $info;
}

//Affichage des constructeur de la base de donnée
function AffichConstruct()
{
  $db=Connexion();
  $Construct = $db->prepare("SELECT * FROM constructeurAuto");
  $Construct->execute();

  return $Construct;
}


/*
Selection de la manière d'afficher les véhicules, suivant l'information récupéré en $test,
avec un système de pagination
 */
function PaginationVehichule($NumPage, $test)
{
  //Nombre d'éléments voulu par page
  $ElementsParPage=6;

  //transforme en numérotation tout ce qui est recu en $_GET['page']
  $NumPage=intval($NumPage);

  if (isset($NumPage) AND !empty($NumPage) AND $NumPage > 0) {
    $pageActuelle=$NumPage;
  } else {
    $pageActuelle=1;
  }

  $depart=($pageActuelle-1)*$ElementsParPage;

  $db=Connexion();

  if ($test==1) {
    $année= intval($_GET['année']);
    $Affiche = $db->prepare("SELECT * FROM vehicule WHERE Année=? LIMIT ?,?");
    $Affiche->bindParam(1, $année, PDO::PARAM_INT);
    $Affiche->bindParam(2, $depart, PDO::PARAM_INT);
    $Affiche->bindParam(3, $ElementsParPage, PDO::PARAM_INT);
  } else if ($test==2) {
    $id=intval($_GET['id']);
    $Affiche = $db->prepare("SELECT * FROM vehicule WHERE idConstru=? LIMIT ?,?");
    $Affiche->bindParam(1, $id, PDO::PARAM_INT);
    $Affiche->bindParam(2, $depart, PDO::PARAM_INT);
    $Affiche->bindParam(3, $ElementsParPage, PDO::PARAM_INT);
  }else {
    $Affiche=$db->prepare("SELECT * FROM vehicule LIMIT ?,?");
    $Affiche->bindParam(1, $depart, PDO::PARAM_INT);
    $Affiche->bindParam(2, $ElementsParPage, PDO::PARAM_INT);
  }
$Affiche->execute();
return $Affiche;
}

function PageNumero($test){

  //Nombre d'éléments voulu par page
  $ElementsParPage=6;

  $db=Connexion();

  if ($test==1) {
    $année= intval($_GET['année']);
    $Affiche = $db->prepare("SELECT * FROM vehicule WHERE Année=?");
    $Affiche->bindParam(1, $année, PDO::PARAM_INT);
  } else if ($test==2) {
    $id=intval($_GET['id']);
    $Affiche = $db->prepare("SELECT * FROM vehicule WHERE idConstru=?");
    $Affiche->bindParam(1, $id, PDO::PARAM_INT);
  }else {
    $Affiche=$db->prepare("SELECT * FROM vehicule");
  }
  $Affiche->execute();

  $NBElements=$Affiche->rowCount();
  $NBpage=ceil($NBElements/$ElementsParPage);

  return $NBpage;
}

//------   Accorde les privilèges suivant les comptes:  ------
// ADMIN= ajout/modif/suppression de constructeurs et voitures --> $privilège = 1
// MODO= ajout/modif/suppression des voitures seulement, lecture pour le reste --> $privilège = 0
function Privilege()
{
  $login=$_SESSION['login'];
  $password=$_SESSION['mdp'];
  $requete=BDD_Utilisateur($login,$password);

  //Attribu les droits de modification en fonction de si l'on est connecté à un compte administrateur ou modérateur
  foreach ($requete as $test) {
    if ($test['pouvoir']==2) {
      $privilege=1;
      } else if ($test['pouvoir']==1) {
        $privilege=0;
        } else {
            die('Vous n\'avez pas les droits d\'acces à cette page');
    }
  }
  return $privilege;
}

//°°°°°°°°°° Ajout ou Modification d'un Constructeur °°°°°°°°°°//
function FormulConstru($accepter)
{
    /*--MODIFICATION--*/
    if ($accepter==1) {

                $db=Connexion();

                $id=$_POST['id'];
                $NomActuel=$_POST['NomConstructeur'];
                $DescriptionActuel=$_POST['Description'];
                $BioActuel=$_POST['Biographie'];

                $constructeur = $db->prepare("UPDATE constructeurAuto SET NomConstru=?, description=?, bio=? WHERE id=?");
                $constructeur->bindParam(1, $NomActuel, PDO::PARAM_STR);
                $constructeur->bindParam(2, $DescriptionActuel, PDO::PARAM_STR);
                $constructeur->bindParam(3, $BioActuel, PDO::PARAM_STR);
                $constructeur->bindParam(4, $id, PDO::PARAM_STR);

                $constructeur->execute();

                header("Location:AdministrationSite.php?msg=".$msg);

    } else {

    /*--AJOUT--*/

          //On teste la taille maximum de l'image
          $tailleMax=2100000;
          $extentionValid= array('jpg','jpeg','png');

          if ($_FILES['imgConstru']['size']<=$tailleMax){

            //On récupère et vérifie l'extension de l'image qu'on upload
            $extensionRecup=pathinfo($_FILES['imgConstru']['name'], PATHINFO_EXTENSION);

            if (in_array(strtolower($extensionRecup),$extentionValid)) {

              //On met l'image dans le dossier de réception
              $chemin= '../Public/img/'.$_FILES['imgConstru']['name'];
              $resultat= move_uploaded_file($_FILES['imgConstru']['tmp_name'],$chemin);

              //On ajoute l'image dans la Bdd
              if ($resultat) {

                $db=Connexion();

                $NomActuel=$_POST['NomConstructeur'];
                $DescriptionActuel=$_POST['Description'];
                $BioActuel=$_POST['Biographie'];
                $liensPourBDD='../Public/img/'.$_FILES['imgConstru']['name'];

                $constructeur = $db->prepare("INSERT INTO constructeurAuto (NomConstru,description,bio,lienLogo) VALUES (?,?,?,?)");
                $constructeur->bindParam(1, $NomActuel, PDO::PARAM_STR);
                $constructeur->bindParam(2, $DescriptionActuel, PDO::PARAM_STR);
                $constructeur->bindParam(3, $BioActuel, PDO::PARAM_STR);
                $constructeur->bindParam(4, $liensPourBDD, PDO::PARAM_STR);
                $constructeur->execute();

                header("Location:AdministrationSite.php");

              }else {
                $msg="erreur sur l'importation finale ...";
              }

            }else {
              $msg = "Votre photo n'est pas au bon format !";
            }

          } else {
            $msg="Votre photo a une taille trop importante";
          }
      }
  //Retourne le message d'erreur suivant la situation
  return $msg;
}


// °°°°°°°°° Ajout ou Modification d'une Voiture °°°°°°°°°° //
function FormulVoiture($accepter)
{
    /*--MODIFICATION--*/
    if ($accepter==1) {

          $db=Connexion();

          $id=$_POST['id'];
          $idConstru=$_POST['selecteurConstru'];
          $NomActuel=$_POST['NomVoiture'];
          $année=$_POST['AnnéeVoiture'];
          $BioActuel=$_POST['Biographie'];

          $constructeur = $db->prepare("UPDATE vehicule SET idConstru=?, NomModèle=?, année=? WHERE id=?");
          $constructeur->bindParam(1, $idConstru, PDO::PARAM_INT);
          $constructeur->bindParam(2, $NomActuel, PDO::PARAM_STR);
          $constructeur->bindParam(3, $année, PDO::PARAM_INT);
          $constructeur->bindParam(4, $id, PDO::PARAM_INT);
          $constructeur->execute();

          header("Location:AdministrationSite.php?msg=".$msg);

    } else {

    /*--AJOUT--*/

          //On teste la taille maximum de l'image
          $tailleMax=2100000;
          $extentionValid= array('jpg','jpeg','png');

          if ($_FILES['imgVoiture']['size']<=$tailleMax){

            //On récupère et vérifie l'extension de l'image qu'on upload
            $extensionRecup=pathinfo($_FILES['imgVoiture']['name'], PATHINFO_EXTENSION);

            if (in_array(strtolower($extensionRecup),$extentionValid)) {

              //On met l'image dans le dossier de réception
              $chemin= '../Public/img/'.$_FILES['imgVoiture']['name'];
              $resultat= move_uploaded_file($_FILES['imgVoiture']['tmp_name'],$chemin);

              //On ajoute l'image dans la Bdd
              if ($resultat) {

                $db=Connexion();

                $id=$_POST['id'];
                $idConstru=$_POST['selecteurConstru'];
                $NomModèle=$_POST['NomVoiture'];
                $Année=$_POST['AnnéeVoiture'];
                $liensPourBDD='../Public/img/'.$_FILES['imgVoiture']['name'];

                $constructeur = $db->prepare("INSERT INTO vehicule (idConstru,NomModèle,année,lienImg) VALUES (?,?,?,?)");
                $constructeur->bindParam(1, $idConstru, PDO::PARAM_INT);
                $constructeur->bindParam(2, $NomModèle, PDO::PARAM_STR);
                $constructeur->bindParam(3, $Année, PDO::PARAM_INT);
                $constructeur->bindParam(4, $liensPourBDD, PDO::PARAM_STR);
                $constructeur->execute();

                header("Location: AdministrationSite.php?msg=".$msg);

              }else {
                $msg="erreur sur l'importation à la base de donnée";
              }

            }else {
              $msg = "Votre photo n'est pas au bon format !";
            }

          } else {
            $msg="Votre photo a une taille trop importante";
          }

        }
  //Retourne le message d'erreur suivant la situation
  return $msg;
}

//Supprime un Utilisateur
function FormulUtilisateur()
{
  $db=Connexion();
  $Pseudo=$_POST['pseudo'];
  $MDP=password_hash($_POST['mdp'], PASSWORD_DEFAULT);
  $Power=$_POST['pouvoir'];

  $Ajouter = $db->prepare("INSERT INTO utilisateurs (pseudo,mdp,pouvoir) VALUES (?,?,?)");
  $Ajouter->bindParam(1, $Pseudo, PDO::PARAM_STR);
  $Ajouter->bindParam(2, $MDP, PDO::PARAM_STR);
  $Ajouter->bindParam(3, $Power, PDO::PARAM_INT);
  $Ajouter->execute();

  header("Location: AdministrationSite.php");
}

//Supprime un constructeur et son fichier image
function SupprimConstructeur($id)
{
  $db=Connexion();

  $img = $db->prepare("SELECT lienLogo FROM constructeurAuto WHERE id=?");
  $img->bindParam(1, $id, PDO::PARAM_INT);
  $img->execute();

  foreach ($img as $imgDestruct) {
    $Liensimg=$imgDestruct['lienLogo'];
  }

  if (unlink($Liensimg)) {
    $db=Connexion();

    $destructeur = $db->prepare("DELETE FROM constructeurAuto WHERE id=?");
    $destructeur->bindParam(1, $id, PDO::PARAM_INT);
    $destructeur->execute();

    return $destructeur;
  }
}


//Supprime un véhicule et son fichier image
function SupprimVoiture($id)
{
  $db=Connexion();

  $img = $db->prepare("SELECT lienImg FROM vehicule WHERE id=?");
  $img->bindParam(1, $id, PDO::PARAM_INT);
  $img->execute();

  foreach ($img as $imgDestruct) {
    $Liensimg=$imgDestruct['lienImg'];
  }

  if (unlink($Liensimg)) {

    $db=Connexion();

    $destructeur = $db->prepare("DELETE FROM vehicule WHERE id=?");
    $destructeur->bindParam(1, $id, PDO::PARAM_INT);
    $destructeur->execute();

    return $destructeur;
  }
}

//Supprime l'utilisateurs
function SupprimUtilisateur($id)
{
  $db=Connexion();

  $destructeur = $db->prepare("DELETE FROM utilisateurs WHERE id=?");
  $destructeur->bindParam(1, $id, PDO::PARAM_INT);
  $destructeur->execute();

  return $destructeur;
}

/*############################################
        VERIFICATION / CONFIRMATION
############################################*/


//Vérifie que le lien est bien transmis d'une page à une autre
function VerificationLien($test)
{
  if (isset($test) AND !empty($test)) {
    $v = (int)$test;
    return $v;
    } else {
        die ('Problème sur la requète...');
      }
}

function VerifAutorisationPage()
{
  if (empty($_SESSION['login'])) {
    die('<h1 class="AdminLOOSE">Vous devez être connecté pour pouvoir entrer sur cette page !</h1><a class="AdminLOOSEbutton" href="/SiteVoiture/ZoneAdmin/Connexion.php">Se Connecter</a><br><a class="AdminLOOSEbutton" href="/SiteVoiture/index.php">Retour a la page d\'accueil</a>');
  }
}

//Vérifie qu'un modérateur n'essaie pas d'arriver à la page
function PasDeModérateur($privilege)
{
  if ($privilege==0) {
    die('<h1 class="AdminLOOSE">Vous n\'avez pas les droits suffisant pour acceder à cette page !</h1><a class="AdminLOOSEbutton" href="/SiteVoiture/ZoneAdmin/Connexion.php">Se Connecter</a><br><a class="AdminLOOSEbutton" href="/SiteVoiture/index.php">Retour à la page d\'accueil</a>');
  }
}

//Vérifie si c'est une mise à jour ou un ajout d'élément
function VerifMajOUAjout()
{
  if (isset($_POST["update"]) && !empty($_POST["update"])) {
    return 1;
  }else{
    return 0;
  }
}

?>
