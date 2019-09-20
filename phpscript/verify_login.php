<?php
session_start();

include_once '../outils/connexion.php';
$conn = new Connexion();

$email = $_POST['email'];//"admin@gmail.com";
$password = hash('sha224', $_POST['password']);//"vanillefrancaise";
$sql = "SELECT pk_utilisateur, courriel, mot_de_passe, administrateur FROM utilisateur WHERE courriel = '".$email."' AND mot_de_passe = '".$password."'";
$result = $conn->getConnexion()->query($sql);



if (mysqli_num_rows($result) == 0){
  echo "01";
}
else{
  include_once 'class/user.php';

  $row = mysqli_fetch_array($result);
  $user = new User($row['pk_utilisateur'], $row['courriel'], $row['mot_de_passe'], $row['administrateur']);


  $_SESSION['user_pk'] = $user->getPk();
  $_SESSION['user_courriel'] = $user->getCourriel();
  $_SESSION['user_motDePasse'] = $user->getMotDePasse();
  $_SESSION['user_administrateur'] = $user->getAdministrateur();

  if ($user->getAdministrateur() == 1)//Si c'est un administrateur
  {
    echo "../page/service.php";
  }
  else //Si c'est un client
  {
    $sql = "SELECT c.prenom, c.nom, c.telephone, c.infolettre, a.no_civique, a.rue, a.code_postal, a.fk_ville
    FROM client AS c
    INNER JOIN adresse AS a  ON c.fk_adresse = a.pk_adresse
    WHERE c.fk_utilisateur = '".$user->getPk()."'";

    $result = $conn->getConnexion()->query($sql);
    $row = mysqli_fetch_array($result);

    $_SESSION['prenom'] = $row['prenom'];
    $_SESSION['nom'] = $row['nom'];
    $_SESSION['telephone'] = $row['telephone'];
    $_SESSION['infolettre'] = $row['infolettre'];
    $_SESSION['no_civique'] = $row['no_civique'];
    $_SESSION['rue'] = $row['rue'];
    $_SESSION['code_postal'] = $row['code_postal'];
    $_SESSION['ville'] = $row['fk_ville'];
    echo "../page/catalogue.php";
  }
}


?>
