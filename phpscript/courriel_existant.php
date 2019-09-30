<?php
session_start();

include_once '../outils/connexion.php';
$conn = new Connexion();

$courriel = $_POST['courriel'];


if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
  $sql = "SELECT pk_utilisateur FROM utilisateur WHERE courriel = '".$courriel."';";
}
else{
  $oldCourriel = $_SESSION['user_courriel'];
  $sql = "SELECT pk_utilisateur FROM utilisateur WHERE courriel = '".$courriel."' AND courriel <> '".$oldCourriel."';";
}

$result = $conn->getConnexion()->query($sql);

if (mysqli_num_rows($result) == 0) {echo "1";}
else {echo "0";}
?>
