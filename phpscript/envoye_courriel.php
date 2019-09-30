<?php


include_once '../outils/connexion.php';

$conn = new Connexion();

$courriel = $_POST['courriel'];
$tempPassword = "kokokiki";
$name = "Monsieur, Madame, ";

$sql = "
UPDATE utilisateur
SET mot_de_passe = '".hash('sha224', $tempPassword)."'
WHERE courriel = '".$courriel."';
";
$result = $conn->getConnexion()->query($sql);


$msg = "Veuillez vous authentifier à l'application
de Simon avec le mot de passe suivant : ".$tempPassword.".
Veuillez ensuite accéder à la page de votre profil
pour changer votre mot de passe. Merci, bye bye.";

$msg = wordwrap($msg,70);

mail($courriel,"Mot de passe oublie",$msg);

?>
