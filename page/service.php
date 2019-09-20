<?php
  session_start();
  // Si non logged in
  if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
    header("Location:login.php");
  }
  else if($_SESSION['user_administrateur'] == 0){
    header("Location:catalogue.php");
  } //Si administrateur

  require_once('../phpscript/class/classService.php');
  require_once('../phpscript/class/gestionService.php');

  $gestionService = new GestionService();

  $arrService = $gestionService->getAllService();

  if(isset($_SESSION['recherche']) && "" != trim($_SESSION['recherche'])){
      $arrService = $gestionService->getServiceBySearch($_SESSION['recherche']);
      unset($_SESSION['recherche']);
  }
  else{
    $arrService = $gestionService->getAllService();
  }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/entete.js"></script>
    <title><?php echo $_SESSION['user_courriel'];?></title>
  </head>
  <body>
    <?php include '../entete/administrateur.php'?>

    <main>
      <?php
        foreach($arrService as $service){
          echo "<div class='cours-d'>
            <div class='cata-gauche'>
              <img src='".$service->getImage()."' alt='Excel Debutant'><br><br>
              <p class='cata-texte'>Promotions :</p>
            </div>

            <div class='cata-droite'>
              <p class='cata-titre'>".$service->getTitre()."</p><br>
              <p class='cata-texte'>".$service->getDescription()."</p>
            </div>

            <div class='cata-tarif'>
              <p class='cata-texte'>Tarif: ".$service->getTarif()."$</p>
            </div>

            <div class='cata-duree'>
              <p class='cata-texte'>Durée: ".$service->getDuree()."h</p>
            </div>

            <div class='service-promo'>
              <img src='../images/promotions/25.png' alt='25%'>
              <img src='../images/promotions/25.png' alt='25%'>
              <img src='../images/promotions/10.png' alt='10%'>
              <i class='fas fa-plus fa-3x'></i>
            </div>

            <div class='res-sociaux'>
              <img src='../images/icones/medias sociaux.jpeg' alt='Médias sociaux'>
            </div>

          </div>";
        }
      ?>


    </main>
  </body>
</html>
