<?php
  session_start();

  if(isset($_POST['noFacture']) && "" != trim($_POST['noFacture'])){
      $_SESSION['noFacture'] = $_POST['noFacture'];
      header("Location:../page/facture.php");
  }
  else if(isset($_POST['nomClient']) && "" != trim($_POST['nomClient'])){
      $_SESSION['nomClient'] = $_POST['nomClient'];
      header("Location:../page/facture.php");
  }
  else if(isset($_POST['service']) && "" != trim($_POST['service'])){
      $_SESSION['serviceFact'] = $_POST['service'];
      header("Location:../page/service.php");
  }
  else if(isset($_POST['recherche']) && "" != trim($_POST['recherche'])){
      $_SESSION['recherche'] = $_POST['recherche'];
      header("Location:../page/service.php");
  }
  else header("Location:../page/service.php"); //Ill have to think about that one
?>
