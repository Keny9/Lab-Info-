<?php
  include_once('./class/gestionService.php');
  include_once('./class/classService.php');

  session_start();

  $gestionService = new GestionService();

  if(isset($_POST['submit'])) {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $duree = $_POST['heure'];

    if(isset($_POST['actif-service'])){
      $actif = 1;
    }
    else {
      $actif = 0;
    }

    $file = $_FILES['file'];

    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'gif');

    if(in_array($fileActualExt, $allowed)){
      if($fileError === 0){
        if($fileSize < 250000){
          $fileNameNew = uniqid('', true).".".$fileActualExt;
          $fileDestination = '../uploads/services/'.$fileNameNew;

          $service = new Service(1,$titre,$description,$duree,$prix,$actif,$fileDestination);

          if(isset($_SESSION['serviceId'])){
            $gestionService->updateService($service);
          }
          else{
            $gestionService->addService($service);
          }

          unset($_SESSION['serviceId']);

          move_uploaded_file($fileTmpName, $fileDestination);
          header("Location: ../page/service.php");
        }
        else{
          $_SESSION['error'] = 1;
          $_SESSION['errorMsg'] = 'Votre fichier est trop gros!';
          headTo();
        }
      }
      else{
        $_SESSION['error'] = 1;
        $_SESSION['errorMsg'] = 'Il y eu une erreur lors du téléversement du fichier.';
        headTo();
      }
    }
    else{
      $_SESSION['error'] = 1;
      $_SESSION['errorMsg'] = 'Vous ne pouvez pas téléverser des fichiers de ce type!';
      headTo();
    }
  }

  //Rediriger comme il le faut
  function headTo(){
    if(isset($_SESSION['serviceId'])){
      header("Location: ../page/serviceModification.php?id=".$_SESSION['serviceId']->getId());
    }
    else{
      header("Location: ../page/serviceModification.php");
    }
  }

?>
