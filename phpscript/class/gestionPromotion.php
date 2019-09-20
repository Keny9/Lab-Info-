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

      $stmt = $conn->prepare("SELECT p.pk_promotion, p.promotion_titre, p.promotion_description, p.rabais, p.image, tps.date_debut, tps.date_fin, tps.code, s.service_titre FROM promotion AS p
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
        $promotion[] = new Promotion($row['pk_promotion'],$row['promotion_titre'],$row['promotion_description'],$row['rabais'],$row['image'],$row['date_debut'],$row['date_fin'],$row['code']);
      }

      $stmt->close();
      return $promotion;
    }
  }
 ?>
