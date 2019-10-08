<?php
  require_once('../outils/connexion.php');
  require_once('user.php');
  require_once('profile.php');

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

    //Verifie si l'utilisateur existe dans la base de donnee
    function getProfile($id){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT c.prenom, c.nom, c.telephone, c.infolettre, a.no_civique, a.rue, a.code_postal, a.fk_ville
                              FROM client AS c
                              INNER JOIN adresse AS a  ON c.fk_adresse = a.pk_adresse
                              WHERE c.fk_utilisateur = ?;");
      $stmt->bind_param("i",$id);

      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $profile = null;
        return $profile;
      }

      $row = $result->fetch_assoc();
      $profile = new Profile($row['pk_client'],$row['fk_utilisateur'],$row['prenom'],$row['nom'],$row['telephone'],$row['no_civique'],$row['rue'],$row['fk_ville'],$row['code_postal'],$row['infolettre']);

      $stmt->close();
      return $profile;
    }
  }



?>
