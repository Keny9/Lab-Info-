<?php
  setlocale(LC_TIME, "fr_FR");

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
  require_once('../phpscript/class/gestionPromotion.php');

  $gestionService = new GestionService();
  $gestionPromotion = new GestionPromotion();

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
      <a class="link-service" href="#">Ajouter un service</a>
      <?php
        if($arrService != null){
          foreach($arrService as $service){
            echo "
            <div class='cours-d'>
              <div class='cata-haut'>
                <div class='cata-gauche'>
                  <img src='".$service->getImage()."' alt='Excel Debutant'><br><br>
                </div>

                <div class='cata-droite'>
                  <p class='cata-titre'>".$service->getTitre()."</p>
                  <a class='link-modifier' href='#'>Modifier</a><br><br>
                  <p class='cata-texte'>".$service->getDescription()."</p>
                </div>

                <div class='cata-tarif'>
                  <p class='cata-texte'>Tarif: ".$service->getTarif()."$</p>
                </div>

                <div class='cata-duree'>
                  <p class='cata-texte'>Durée: ".$service->getDuree()."h</p>
                </div>
              </div>

              <div class='promo'>
                <p class='text-promo'>Promotions :</p>";

                  $arrPromotion = $gestionPromotion->getPromotionOfService($service->getId());

                  if($arrPromotion != null){
                    foreach($arrPromotion as $promotion){
                      echo "<a href='#' class='promotion'>- ".$promotion->getTitre()." (du ".strftime("%e %B", strtotime($promotion->getDateDebut()))." au ".strftime("%e %B", strtotime($promotion->getDateFin())).")</a>";
                    }
                  }
                  else{
                    echo "<a class='promotion'></a>";
                  }

                echo
                "<img id='add-promo' src='../images/promotions/add-button.png' alt='ajout-promotion'>
              </div>
              <div class='res-sociaux'>
                <img src='../images/icones/medias sociaux.jpeg' alt='Médias sociaux'>
              </div>

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
