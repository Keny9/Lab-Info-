<?php
  include_once('./class/gestionService.php');
  include_once('./class/classService.php');

  session_start();

  if (isset($_POST['submit'])) {
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
          $fileDestination = '../uploads/'.$fileNameNew;
          move_uploaded_file($fileTmpName, $fileDestination);
          header("Location: ../page/service.php");
        }
        else{
          $_SESSION['error'] = 1;
          $_SESSION['errorMsg'] = 'Votre fichier est trop gros!';
          header("Location: ../page/serviceModification.php?index=".$_SESSION['indexService']);
        }
      }
      else{
        $_SESSION['error'] = 1;
        $_SESSION['errorMsg'] = 'Il y eu une erreur lors du téléversement du fichier.';
        header("Location: ../page/serviceModification.php?index=".$_SESSION['indexService']);
      }
    }
    else{
      $_SESSION['error'] = 1;
      $_SESSION['errorMsg'] = 'Vous ne pouvez pas téléverser des fichiers de ce type!';
      header("Location: ../page/serviceModification.php?index=".$_SESSION['indexService']);
    }
  }

  //unset($_SESSION['indexService']);

?>
