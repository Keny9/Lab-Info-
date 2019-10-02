<?php
session_start();
include_once '../outils/connexion.php';
$conn = new Connexion();

$sql = "
SELECT pk_utilisateur FROM utilisateur
WHERE courriel = '".$_SESSION['user_courriel']."';
";
$result = $conn->getConnexion()->query($sql);
$row = mysqli_fetch_array($result);
$key_user = $row['pk_utilisateur'];

$sql = "
SELECT pk_client, fk_adresse FROM client
WHERE fk_utilisateur = '".$key_user."';
";
$result = $conn->getConnexion()->query($sql);
$row = mysqli_fetch_array($result);
$key_client = $row['pk_client'];
$key_adresse = $row['fk_adresse'];

//ADRESSE
$no_civique = $_POST["no"];
$rue = $_POST["rue"];
$fk_ville = $_POST["ville"];
$code_postal = $_POST["code_postal"];
$code_postal = str_replace(' ', '', $code_postal);
$code_postal = str_replace('-', '', $code_postal);
$code_postal = strtoupper($code_postal);

//do update adresse
$sql = "
UPDATE adresse
SET no_civique = '".$no_civique."',
rue = '".$rue."',
fk_ville = ".$fk_ville.",
code_postal = '".$code_postal."'
WHERE pk_adresse = '".$key_adresse."';
";

$result = $conn->getConnexion()->query($sql);

//CLIENT
$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$telephone = $_POST["telephone"];
$infolettre = 0;
if($_POST["prom"] == "1"){
  $infolettre = 1;
}

//do insert client
$sql = "
UPDATE client
SET prenom = '".$prenom."',
nom = '".$nom."',
telephone = '".$telephone."',
infolettre = ".$infolettre."
WHERE fk_utilisateur = '".$key_user."';
";

$result = $conn->getConnexion()->query($sql);

var_dump($result);
echo $key_user." ".$prenom." ".$nom." ".$key_adresse." ".$telephone." ".$infolettre;
header("Location: ../page/login.php");
?>
