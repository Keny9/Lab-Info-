<?php
  include_once("./class/promotion.php");
  include_once("./class/gestionPromotion.php");

  $gestionPromotion = new GestionPromotion();

  if(isset($_POST['submit'])){
    $promotion = new Promotion($_POST['idPromotion'],null,$_POST['nomPromo'],null,$_POST['rabaisPromo'],null,null,null,null,null);

    if($_POST['mode'] == "add"){
      $gestionPromotion->addPromotion($promotion);
    }
    else if($_POST['mode'] == "update"){
      $gestionPromotion->updatePromotion($promotion);
    }
    header("Location: ../page/promotion.php");
  }


?>
