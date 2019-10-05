<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/GestionUser.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/user.php');

  session_start();

  $gestionUser = new GestionUser();
  $nomComplet = $_POST['name'];
  $courriel = $_POST['email'];
  $id = $_POST['id'];

  $user = $gestionUser->checkIfUserExist($courriel);

  $_SESSION['user_courriel'] = $courriel;
  $_SESSION['user_administrateur'] = 0;
  $_SESSION['facebook_login'] = 1;

  echo json_encode($user);

?>
