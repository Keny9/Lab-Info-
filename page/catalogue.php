<?php
  require_once('../phpscript/class/classService.php');
  require_once('../phpscript/class/gestionService.php');

  session_start();

  // Si non logged in
  if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
    $header = '../entete/nonConnecter.php';
  }
  else if($_SESSION['user_administrateur'] == 1){
    header("Location:service.php");
  } //Si administrateur
  else {
    $header = '../entete/client.php';
  } // Si client

  $gestionService = new GestionService();

  if(isset($_POST['recherche']) && "" != trim($_POST['recherche'])){
      $arrService = $gestionService->getServiceBySearch($_POST['recherche']);
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/entete.js"></script>
    <title>Info++</title>
  </head>
  <body>
    <?php include $header/*'../entete/client.php';*/ ?>

    <main>
      <?php
      if($arrService != null){
        foreach($arrService as $service){
          echo
          "<div class='cours-d'>
              <div class='cata-haut'>
              <div class='cata-gauche'>
                <img src='".$service->getImage()."' alt='Magic Name'><br>
              </div>

              <div class='cata-droite'>
                <p class='cata-titre'>".$service->getTitre()."</p><br>
                <p class='cata-texte'>".$service->getDescription()."</p>
              </div>
            </div>

            <div class='cata-vide'></div>

            <div class='cata-detail'>
              <div class='cata-tarif'>
                <p class='cata-texte'>Tarif: ".$service->getTarif()."$</p>
              </div>

              <div class='cata-duree'>
                <p class='cata-texte'>Durée: ".$service->getDuree()."h</p>
              </div>
            </div>

            <img src='../images/icones/panier.png' alt='Panier' class='panier'>

          </div>";
        }
      }
      else{
        echo "<p class='cata-texte'>Désolé, aucun service correspond à la recherche.</p>";
      }


      ?>

    </main>

  </body>
</html>
