<?php
session_start();

include_once '../outils/connexion.php';
$conn = new Connexion();

$email = "admin@gmail.com";
$password = "vanillefrancaise";
$sql = "SELECT pk_utilisateur, courriel, mot_de_passe, administrateur FROM utilisateur WHERE courriel = '".$email."'";
$result = $conn->getConnexion()->query($sql);

$row = mysqli_fetch_array($result);
//print_r($row);
echo $row['mot_de_passe'];
echo "<br>";
echo hash('sha224', $password);
/*if (hash('sha224', $password)==$row['mot_de_passe']) {
  echo "Bon mot de passe";
}
else{
  echo "Mauvais mot de passe ";
  echo hash('sha224', $password);
}*/
?>
