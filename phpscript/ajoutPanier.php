<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/gestionService.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/classService.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/gestionPromotion.php');

  session_start();

  $gestionService = new GestionService();
  $gestionPromotion = new GestionPromotion();

  $idService = $_POST['id'];
  $itemExistant = false;

  $service = $gestionService->getService($idService);
  $arrPromotion = $gestionPromotion->getPromotionOfService($service->getId());

  if(isset($_SESSION['panier'])){
    foreach($_SESSION['panier'] as $item){
      if($item->getId() == $service->getId()){
        $item->setQty($item->getQty() + 1);
        $itemExistant = true;
      }
    }
    if($itemExistant == false){ //ajout nouveau service
      $service->setQty($service->getQty() + 1);
      $_SESSION['panier'][] = $service;
    }
  }
  else {
    $_SESSION['panier'] = array();
    $service->setQty($service->getQty() + 1);
    $_SESSION['panier'][] = $service;
  }
  $_SESSION['qty'] += 1;

  $_SESSION['sousTotal'] += ($service->getTarif() * $service->getQty());

  if($arrPromotion != null){
    foreach($arrPromotion as $promotion){
      $rabais = (($service->getTarif() * $service->getQty()) * $promotion->getRabais());
      $_SESSION['sousTotal'] -= $rabais;
    }
  }

  $_SESSION['sousTotal'] = round($_SESSION['sousTotal'],2,PHP_ROUND_HALF_UP);

  $_SESSION['tps'] = round($_SESSION['sousTotal'] * (5/100),2, PHP_ROUND_HALF_UP);
  $_SESSION['tvq'] = round($_SESSION['sousTotal'] * (9.975/100),2, PHP_ROUND_HALF_UP);
  $_SESSION['total'] = round($_SESSION['sousTotal'] + $_SESSION['tps'] + $_SESSION['tvq'],2, PHP_ROUND_HALF_UP);

  echo json_encode($_SESSION['qty']);


?>
