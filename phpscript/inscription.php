<?php
include_once '../outils/connexion.php';
$conn = new Connexion();



//USER
//$pk_utilisateur
$courriel = $_POST["courriel"];
$mot_de_passe = $_POST["password"];
$administrateur = 0;

//do insert user
$sql = "
INSERT INTO utilisateur (courriel, mot_de_passe, administrateur)
VALUES ('".$courriel."','".hash('sha224', $mot_de_passe)."', ".$administrateur.");
";

$result = $conn->getConnexion()->query($sql);
//ADRESSE

$no_civique = $_POST["no"];
$rue = $_POST["rue"];
$fk_ville = $_POST["ville"];
$code_postal = $_POST["code_postal"];
$code_postal = str_replace(' ', '', $code_postal);
$code_postal = str_replace('-', '', $code_postal);
$code_postal = strtoupper($code_postal);
//do insert adresse
$sql = "
INSERT INTO adresse (no_civique, rue, fk_ville, code_postal)
VALUES ('".$no_civique."','".$rue."', ".$fk_ville.", '".$code_postal."');
";

$result = $conn->getConnexion()->query($sql);
//CLIENT
$sql = "
SELECT pk_utilisateur FROM utilisateur
WHERE courriel = '".$courriel."';
";
$result = $conn->getConnexion()->query($sql);
$row = mysqli_fetch_array($result);
$fk_utilisateur = $row['pk_utilisateur'];

$sql = "
SELECT pk_adresse FROM adresse
WHERE no_civique = '".$no_civique."'
AND rue = '".$rue."'
AND fk_ville = ".$fk_ville."
AND code_postal = '".$code_postal."';
";

$result = $conn->getConnexion()->query($sql);
$row = mysqli_fetch_array($result);
$fk_adresse = $row['pk_adresse'];

$prenom = $_POST["prenom"];
$nom = $_POST["nom"];
$telephone = $_POST["telephone"];
$infolettre = 0;
if($_POST["prom"] == "1"){
  $infolettre = 1;
}

//do insert client
$sql = "
INSERT INTO client (fk_utilisateur, prenom, nom, fk_adresse, telephone, infolettre)
VALUES (".$fk_utilisateur.",'".$prenom."', '".$nom."', ".$fk_adresse.", '".$telephone."', ".$infolettre.");
";

$result = $conn->getConnexion()->query($sql);

var_dump($result);
echo $fk_utilisateur." ".$prenom." ".$nom." ".$fk_adresse." ".$telephone." ".$infolettre;

header("Location: ../page/login.php");
?>
