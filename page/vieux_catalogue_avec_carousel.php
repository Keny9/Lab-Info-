<?php
  require_once('../phpscript/class/classService.php');
  require_once('../phpscript/class/gestionService.php');
  require_once('../phpscript/class/gestionPromotion.php');
  require_once('../phpscript/class/promotion.php');

  $gestionService = new GestionService();
  $gestionPromotion = new GestionPromotion();

  $arrService = $gestionService->getAllService();
  $arrPromotion = $gestionPromotion->getAllPromotionWithServices();

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

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/carousel.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/carousel.js"></script>
    <title>Info++</title>
  </head>
  <body>
    <?php include $header/*'../entete/client.php';*/ ?>


    <main>
      <div class="carousel">
        <div class="defilement-container">
          <div class="spacer"></div>
          <div id="carouselPrevious"class="carousel-bouton">
            <
          </div>
        </div>

        <div id="carouselItemContainer">
          <?php
            foreach($arrPromotion as $promotion){
              echo "
              <div class=\"carousel-item\">
                <div class=\"carousel-titre\">
                  <h1>".$promotion->getTitre()."</h1>
                </div>
                <div class=\"carousel-description\">
                  <p>".$promotion->getDescription()."</p>
                </div>
                <div class=\"carousel-service\">
                  <h2>Service couvert :</h2>
                  <ul>
                    ";
                    foreach($promotion->getServices() as $service){
                      echo '<li>'.$service.'</li>';
                    }
                    echo "
                  </ul>
                </div>
              </div>
              ";
            }
          ?>
        </div>

        <div class="defilement-container">
          <div class="spacer"></div>
          <div id="carouselNext"class="carousel-bouton">
            >
          </div>
        </div>
      </div>

      <?php
        foreach($arrService as $service){
          echo "<div class='cours-d'>
            <div class='cata-gauche'>
              <img src='".$service->getImage()."' alt='Excel Debutant'><br>
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

            <img src='../images/icones/panier.png' alt='Panier' id='panier'>

          </div>";
        }

      ?>

    </main>

  </body>
</html>
