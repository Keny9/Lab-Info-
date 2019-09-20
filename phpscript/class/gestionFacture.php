<?php
  require_once("../outils/connexion.php");
  require_once("facture.php");

  class GestionFacture{

    public function getAllFacture(){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT f.pk_facture, c.prenom, c.nom, f.date_service, f.paiement_status, f.no_confirmation FROM facture AS f
                    INNER JOIN client c ON f.fk_client = c.pk_client ORDER BY f.date_service DESC;");

      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0) exit('Pas de ligne');

      while($row = $result->fetch_assoc()){
        $facture[] = new Facture($row['pk_facture'], $row['prenom'], $row['nom'],$row['date_service'],$row['paiement_status'],$row['no_confirmation']);
      }

      $stmt->close();
      return $facture;
    }

    //Obtenir les services liés à une facture
    public function getServicesOfFacture($idFacture){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();
      $arrIdService = array();

      $stmt = $conn->prepare("SELECT * FROM ta_facture_service WHERE fk_facture = ?;");
      $stmt->bind_param("i",$id);

      $id = $idFacture;
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0) exit('Pas de ligne');

      while($row = $result->fetch_assoc()){
        array_push($arrIdService,$row['fk_service']);
      }

      $stmt->close();
      return $arrIdService;
    }

    //Obtenir les montants d'une facture
    public function getTarifFacture($id){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();
      $arrTarif = array();

      $stmt = $conn->prepare("SELECT tarif_facture FROM ta_facture_service WHERE fk_facture = ?;");
      $stmt->bind_param("i",$id);

      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0) exit('Pas de ligne');

      while($row = $result->fetch_assoc()){
        array_push($arrTarif,$row['tarif_facture']);
      }

      $stmt->close();
      return $arrTarif;
    }

    //Obtenir une facture a l'aide du numero de la facture
    public function getFactureById($id){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT * FROM facture f
                              INNER JOIN client c ON f.fk_client = c.pk_client
                              WHERE pk_facture = $id;");
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $facture = null;
      }
      else{
        $row = $result->fetch_assoc();
        $facture[] = new Facture($row['pk_facture'], $row['prenom'], $row['nom'],$row['date_service'],$row['paiement_status'],$row['no_confirmation']);
      }
      $stmt->close();
      return $facture;
    }

    //Obtenir des facture par le nom d'un client
    public function getFactureByName($name){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT * FROM facture f
                              INNER JOIN client c ON f.fk_client = c.pk_client
                              WHERE CONCAT(c.prenom, ' ', c.nom) LIKE '%$name%';");
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $facture = null;
      }
      else{
        while($row = $result->fetch_assoc()){
          $facture[] = new Facture($row['pk_facture'], $row['prenom'], $row['nom'],$row['date_service'],$row['paiement_status'],$row['no_confirmation']);
        }
      }
      $stmt->close();
      return $facture;
    }

  }
?>
