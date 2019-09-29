<?php
  include_once("./class/promotion.php");
  include_once("./class/gestionPromotion.php");

  session_start();

  $gestionPromotion = new GestionPromotion();

  if(isset($_POST['submit'])){
    $idPromo = $_POST['promotion'][0]; //id de la promotion
    $idService = $_GET['id'];
    $rabais = $_POST['rabais'];
    $startDate = date('Y-m-d', strtotime($_POST['startDate']));
    $endDate = date('Y-m-d', strtotime($_POST['endDate']));
    $code = $_POST['code'];

    if($startDate <= $endDate){
      if(isset($_SESSION['idPromo'])){ //update
        $promotion = new Promotion($idPromo,$_SESSION['idPromo'],null,null,$rabais,null,$startDate,$endDate,$code,$idService);
        $gestionPromotion->updatePromoService($promotion);
      }
      else{
        $gestionPromotion->addPromoService($idPromo, $idService, $startDate, $endDate, $code); //ajout
      }

      unset($_SESSION['idPromo']);
      //header("Location: ../page/service.php");
    }
    else{
      $_SESSION['error'] = 1;
      $_SESSION['errorMsg'] = 'Entrer une date de départ inférieur ou égal à celle de fin.';
      header("Location: ../page/promotionService.php?id=".$_GET['id']."");
    }

  }

?>
