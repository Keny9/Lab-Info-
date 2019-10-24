<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/gestionService.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/classService.php');

  session_start();

  $gestionService = new GestionService();
  $idService = $_POST['id'];
  $itemExistant = false;

  $service = $gestionService->getService($idService);

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

  $_SESSION['qty'] = count($_SESSION['panier']);

  echo json_encode(count($_SESSION['panier']));


?>
