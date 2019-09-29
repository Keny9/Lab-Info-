<?php
  require_once('../outils/connexion.php');
  require_once('promotion.php');

  class GestionPromotion{

    /**
    * Obtenir toutes les promotions qui ont été ou qui sont actives sur un service
    * @param id d'un service
    */
    public function getPromotionOfService($id){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT p.pk_promotion, tps.pk_promotion_service, p.promotion_titre, p.promotion_description, p.rabais, p.image, tps.date_debut, tps.date_fin, tps.code, s.service_titre, s.pk_service FROM promotion AS p
                              INNER JOIN ta_promotion_service tps ON p.pk_promotion = tps.fk_promotion
                              INNER JOIN service s ON tps.fk_service = s.pk_service WHERE s.pk_service = ?;");

      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $promotion = null;
        return $promotion;
      }

      while($row = $result->fetch_assoc()){
        $promotion[] = new Promotion($row['pk_promotion'],$row['pk_promotion_service'],$row['promotion_titre'],$row['promotion_description'],$row['rabais'],$row['image'],$row['date_debut'],$row['date_fin'],$row['code'],$row['pk_service']);
      }

      $stmt->close();
      return $promotion;
    }

    //Obtenir toutes les promotions de la bd
    public function getAllPromotion(){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT * FROM promotion;");

      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $arrPromotion = null;
        return $arrPromotion;
      }

      while($row = $result->fetch_assoc()){
        $arrPromotion[] = new Promotion($row['pk_promotion'],null,$row['promotion_titre'],$row['promotion_description'],$row['rabais'],$row['image'],null,null,null,null);
      }

      $stmt->close();
      return $arrPromotion;
    }

    //Obtenir l'association entre un service et une promotion
    public function getPromotion($id){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT p.pk_promotion, tps.pk_promotion_service, p.promotion_titre, p.promotion_description, p.rabais, p.image, tps.date_debut, tps.date_fin, tps.code, s.service_titre, s.pk_service FROM promotion AS p
                              INNER JOIN ta_promotion_service tps ON p.pk_promotion = tps.fk_promotion
                              INNER JOIN service s ON tps.fk_service = s.pk_service
                              WHERE tps.pk_promotion_service = ?;");

      $stmt->bind_param("i",$id);
      $stmt->execute();
      $result = $stmt->get_result();

      if($result->num_rows == 0){
        $promotion = null;
        return $promotion;
      }

      $row = $result->fetch_assoc();
      $promotion = new Promotion($row['pk_promotion'],$row['pk_promotion_service'],$row['promotion_titre'],$row['promotion_description'],$row['rabais'],$row['image'],$row['date_debut'],$row['date_fin'],$row['code'],$row['pk_service']);

      $stmt->close();
      return $promotion;

    }

    /**
    * Fonction qui permet d'obtenir le dernier id d'un promo-service
    */
    public function getLastId(){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("SELECT MAX(pk_promotion_service) FROM ta_promotion_service;");
      $stmt->execute();

      $result = $stmt->get_result();

      if(!$result){
        die('Could not query:' . mysqli_error());
      }

      $row = $result->fetch_assoc();
      $lastId = $row['MAX(pk_promotion_service)'] + 1;

      $stmt->close();
      return $lastId;
    }

    //Créer un nouveau lien dans la base de donnée
    public function addPromoService($idPromotion, $idServ, $date_debut, $date_fin, $code2){
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("INSERT INTO ta_promotion_service (pk_promotion_service, fk_promotion, fk_service, date_debut, date_fin, code) VALUES
                            (?, ?, ?, ?, ?, ?);");
      $stmt->bind_param("iiisss", $id, $idPromo, $idService, $dateDebut, $dateFin, $code);

      //set parameters
      $id = $this->getLastId();
      $idService = $idServ;
      $idPromo = $idPromotion;
      $dateDebut = $date_debut;
      $dateFin = $date_fin;
      $code =  $code2;

      $stmt->execute();
      $stmt->close();
    }

    //Fonction qui permet de mettre à jour un une promo lier a un service
    public function updatePromoService($promotion){ //TODO: Completer le update, faire en sorte que les dates s'update
      $connexion = new Connexion();
      $conn = $connexion->getConnexion();

      $stmt = $conn->prepare("UPDATE ta_promotion_service
                              SET fk_promotion = ?, fk_service = ?, date_debut = ?, date_fin = ?, code = ?
                              WHERE pk_promotion_service = ?;");
      $stmt->bind_param("iisssi", $fk_promotion, $fk_service, $date_debut, $date_fin, $code, $pk_promotion_code);

      //set parameters
      $fk_promotion = $promotion->getId();
      $fk_service = $promotion->getService();
      $date_debut = $promotion->getDateDebut();
      $date_fin = $promotion->getDateFin();
      $code = $promotion->getCode();
      $pk_promotion_code = $promotion->getIdPromoService();

      $status = $stmt->execute();
      /* check whether the execute() succeeded */
      if ($status === false) {
        trigger_error($stmt->error, E_USER_ERROR);
      }

      $stmt->close();
    }

    /**
    * Obtenir toutes les promotions disponibles auquels un client peut adérer sous forme de données
    */
    public function getAllPromoData(){
      $connection = new Connexion();
      $conn = $connection->getConnexion();

      $data = array();

      $query = "SELECT * FROM promotion;";
      $result = mysqli_query($conn,$query);

      if(mysqli_num_rows($result) == 0){
        $data = null;
      }
      else{
        while($row = mysqli_fetch_assoc($result)){
          $data[] = $row;
        }
      }
      return $data;
    }
  }
 ?>
