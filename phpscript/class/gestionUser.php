<?php
  require_once('../outils/connexion.php');
  require_once('user.php');

  class GestionUser{

    //Verifie si l'utilisateur existe dans la base de donnee
    function checkIfUserExist($email){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT pk_utilisateur FROM utilisateur WHERE courriel = ?;");
      $stmt->bind_param("s",$email);

      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $user = null;
        return $user;
      }

      $row = $result->fetch_assoc();
      $user = new User($row['pk_utilisateur'],$row['courriel'],null,$row['administrateur']);

      $stmt->close();

      return $user;
    }
  }



?>
