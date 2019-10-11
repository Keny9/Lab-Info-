<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/GestionUser.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/user.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/profile.php');

  session_start();

  $gestionUser = new GestionUser();
  $nomComplet = $_POST['name'];
  $courriel = $_POST['email'];
  $id = $_POST['id'];

  $user = $gestionUser->checkIfUserExist($courriel);

  $_SESSION['user_courriel'] = $courriel;
  $_SESSION['user_administrateur'] = 0;
  $_SESSION['facebook_login'] = 1; //Connecter avec facebook
  $_SESSION['fb_profile'] = 0;

  if($user != null){ //la personne a un profile Info++
    $profile = $gestionUser->getProfile($user->getPk());
    $_SESSION['nom'] = $profile->getNom();
    $_SESSION['prenom'] = $profile->getPrenom();
    $_SESSION['telephone'] = $profile->getTelephone();
    $_SESSION['no_civique'] = $profile->getNoCivique();
    $_SESSION['rue'] = $profile->getRue();
    $_SESSION['ville'] = $profile->getVille();
    $_SESSION['user_motDePasse'] = 'tu le sauras jamais';
    $_SESSION['code_postal'] = $profile->getCodePostal();
    $_SESSION['fb_profile'] = 1;
  }
  else{
    $gestionUser->addUserFacebook($id,$courriel); //Inscrire en tant que nouveau user
  }

  echo json_encode($user);

?>
