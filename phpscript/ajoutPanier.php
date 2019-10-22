<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/gestionService.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/classService.php');

  session_start();

  $gestionService = new GestionService();
  $idService = $_POST['id'];

  $service = $gestionService->getService($idService);

  if(isset($_SESSION['panier'])){
    $_SESSION['panier'][] = $service;
  }
  else {
    $_SESSION['panier'] = array();
    $_SESSION['panier'][] = $service;
  }

  $_SESSION['qty'] = count($_SESSION['panier']);

  echo json_encode(count($_SESSION['panier']));


?>
