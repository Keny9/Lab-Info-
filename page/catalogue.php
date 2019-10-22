<?php
  require_once('../phpscript/class/classService.php');
  require_once('../phpscript/class/gestionService.php');
  require_once('../phpscript/class/gestionPromotion.php');
  require_once('../phpscript/class/promotion.php');

  $gestionPromotion = new GestionPromotion();
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
    <meta property="og:url"           content="https://localhost/AppMedia/page/catalogue.php" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Info++ Catalogue" />
    <meta property="og:description"   content="Venez apprendre avec les divers cours offert par Info++." />
    <meta property="og:image"         content="https://localhost/AppMedia/images/icones/logo.png" />
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/carousel.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/entete.js"></script>
    <script type="text/javascript" src="../js/carousel.js"></script>
    <script type="text/javascript" src="../js/catalogue.js"></script>
    <title>Info++</title>
  </head>
  <body>
    <?php include $header?>

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
      if($arrService != null){
        foreach($arrService as $service){
          if($service->getActif() == 1){
            echo
            "<div class='cours-d'>
                <div class='cata-haut'>
                <div class='cata-gauche'>
                  <img src='".$service->getImage()."' alt='Magic Name'><br>
                </div>
                <input type='hidden' id='idService".$service->getId()."' value='".$service->getId()."'>
                <div class='cata-droite'>
                  <p class='cata-titre'>".$service->getTitre()."</p><br><br>
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

              <img src='../images/icones/panier.png' alt='Panier' class='panier' onclick='ajoutService(".$service->getId().");'>

            </div>";
          }
        }
      }
      else{
        echo "<p class='cata-texte'>Désolé, aucun service correspond à la recherche.</p>";
      }


      ?>

    </main>

  </body>
</html>
