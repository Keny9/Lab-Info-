<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/gestionService.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/classService.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/gestionPromotion.php');
  session_start();

  $_SESSION['tps'] = $_POST['tps'];
  $_SESSION['tvq'] = $_POST['tvq'];
  $_SESSION['sousTotal'] = $_POST['sousTotal'];
  $_SESSION['total'] = $_POST['total'];

  $index = 0;

  foreach($_SESSION['panier'] as $item){
    if($item->getId() == $_POST['id']){
      $_SESSION['qty'] -= $item->getQty();
      $item->setQty($_POST['qty']);
      $_SESSION['qty'] += $item->getQty();

      if($item->getQty() == 0){
        unset($_SESSION['panier'][$index]);
        if($_SESSION['panier']['0']->getQty() == 0){
          unset($_SESSION['panier']);
        }
      }
    }
    $index++;
  }

  echo json_encode("It's done");
 ?>
