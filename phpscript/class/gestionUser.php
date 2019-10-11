<?php
  require_once('../outils/connexion.php');
  require_once('user.php');
  require_once('profile.php');

  class GestionUser{

    //Verifie si l'utilisateur existe dans la base de donnee
    function checkIfUserExist($email){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT * FROM utilisateur WHERE courriel = ?;");
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
    function getProfile($idF){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT c.pk_client, c.fk_utilisateur, c.prenom, c.nom, c.telephone, c.infolettre, a.no_civique, a.rue, a.code_postal, a.fk_ville
                              FROM client AS c
                              INNER JOIN adresse AS a  ON c.fk_adresse = a.pk_adresse
                              WHERE c.fk_utilisateur = ?;");
      $stmt->bind_param("i",$id);

      $id = $idF;

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

    /**
    * Fonction qui permet d'obtenir le dernier id d'un profil
    */
    public function getLastId(){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT MAX(pk_client) FROM client;");
      $stmt->execute();

      $result = $stmt->get_result();

      if(!$result){
        die('Could not query:' . mysqli_error());
      }

      $row = $result->fetch_assoc();
      $lastId = $row['MAX(pk_client)'] + 1;

      $stmt->close();
      return $lastId;
    }

    /**
    * Fonction qui permet d'obtenir le dernier id d'un profil
    */
    public function getLastIdAdresse(){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT MAX(pk_adresse) FROM adresse;");
      $stmt->execute();

      $result = $stmt->get_result();

      if(!$result){
        die('Could not query:' . mysqli_error());
      }

      $row = $result->fetch_assoc();
      $lastId = $row['MAX(pk_adresse)'] + 1;

      $stmt->close();
      return $lastId;
    }

    //Ajouter l'utilisateur Facebook
    function addUserFacebook($idF,$courrielF){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("INSERT INTO utilisateur (pk_utilisateur,courriel,mot_de_passe,administrateur) VALUES (?,?,?,?);");
      $stmt->bind_param("issi",$id,$courriel,$mot_de_passe,$administrateur);

      $id = $idF;
      $courriel = $courrielF;
      $mot_de_passe = null;
      $administrateur = 0;

      $stmt->execute();
      $stmt->close();

      $this->addAdresse($idF);
    }

    //Creer un profil pour l'utilisateur
    function addProfileFacebook($idF,$idAdresse){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("INSERT INTO client (pk_client,fk_utilisateur,prenom,nom,fk_adresse,telephone,infolettre) VALUES (?,?,?,?,?,?,?);");
      $stmt->bind_param("iissisi",$id,$idUser,$prenom,$nom,$fk_adresse,$telephone,$infolettre);

      $id = $this->getLastId();
      $idUser = $idF;
      $prenom = null;
      $nom = null;
      $fk_adresse = $idAdresse;
      $telephone = null;
      $infolettre = null;

      $stmt->execute();
      $stmt->close();

    }

    //Creer une adresse au profil
    function addAdresse($idF){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("INSERT INTO adresse (pk_adresse,no_civique,rue,fk_ville,code_postal) VALUES (?,?,?,?,?);");
      $stmt->bind_param("iisis",$idAdresse,$noCivique,$rue,$ville,$codePostal);

      $idAdresse = $this->getLastIdAdresse();
      $noCivique = null;
      $rue = null;
      $ville = null;
      $codePostal = null;

      $stmt->execute();
      $stmt->close();

      $this->addProfileFacebook($idF,$idAdresse);
    }
  }



?>
