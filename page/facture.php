<?php
  require_once("../phpscript/class/facture.php");
  require_once("../phpscript/class/gestionFacture.php");
  require_once("../phpscript/class/classService.php");
  require_once("../phpscript/class/gestionService.php");
  require_once("../phpscript/class/GestionPromotion.php");

  session_start();
  // Si non logged in
  if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
    header("Location:login.php");
  }
  else if($_SESSION['user_administrateur'] == 0){
    header("Location:catalogue.php");
  } //Si administrateur

  $gestionFacture = new GestionFacture();
  $gestionService = new GestionService();
  $gestionPromotion = new GestionPromotion();

  if(isset($_SESSION['noFacture']) && "" != trim($_SESSION['noFacture']) && is_numeric($_SESSION['noFacture'])){
    $arrFacture = $gestionFacture->getFactureById($_SESSION['noFacture']);
    unset($_SESSION['noFacture']);
  }
  else if(isset($_SESSION['nomClient']) && "" != trim($_SESSION['nomClient'])){
    $arrFacture = $gestionFacture->getFactureByName($_SESSION['nomClient']);
    unset($_SESSION['nomClient']);
  }
  else{
    $arrFacture = $gestionFacture->getAllFacture();
  }

  $i = 0; //Iteration pour changer les id
  $totalFacture = 0;
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Info++</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/facture.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/entete.js"></script>
    <script type="text/javascript" src="../js/facture.js"></script>
  </head>
  <body>
    <?php include '../entete/administrateur.php'; ?>

    <main>
      <?php
        if($arrFacture != null){
          foreach($arrFacture as $facture){
            $arrIdService = $gestionFacture->getServicesOfFacture($facture->getId());

            $arrTarif = $gestionFacture->getTarifFacture($facture->getId());

            //Calculer le total de la facture
            foreach($arrTarif as $tarif){
              $totalFacture += $tarif;
            }

            foreach($arrIdService as $idService){
              $arrService[] = $gestionService->getService($idService);
            }

            echo "<div class='facture'>

              <div class='fact-l-1'>
                <p class='text-fact id-facture'>".$facture->getId()."</p>
                <p class='text-fact facture-client'>".$facture->getPrenomClient()." ".$facture->getNomClient()."</p>
                <p class='text-fact date-facture'>".$facture->getDateService()."</p>
              </div>

              <div class='fact-l-2'>
                <p class='text-fact fact-confirmation'>".$facture->getNoConfirmation()."</p>
                <p class='text-fact fact-total'>".number_format($totalFacture,2)."$</p>
                <p class='fact-detail' onclick='afficheDetail(".$i.")' id='link-detail-".$i."'>Détail</p>
              </div>

              <span class='block-detail' id='block-detail-".$i."'>
                <div class='fact-l-3'>";

                  foreach($arrService as $service){
                    $arrPromotion = $gestionPromotion->getPromotionOfService($service->getId());
                    echo "<p>".$service->getTitre()."</p>";

                    if($arrPromotion != null){
                      foreach($arrPromotion as $promotion){
                        if($facture->getDateService() > $promotion->getDateDebut() && $facture->getDateService() < $promotion->getDateFin()){
                          echo "<p class='rabais'>".$promotion->getTitre()."</p>";
                        }
                      }
                    }
                  }

              echo"  </div>

                <div class='fact-l-4'>";
                  foreach($arrService as $service){
                    $arrPromotion = $gestionPromotion->getPromotionOfService($service->getId());
                    echo "<p>".$service->getTarif()."$</p>";

                    if($arrPromotion != null){
                      foreach($arrPromotion as $promotion){
                        if($facture->getDateService() > $promotion->getDateDebut() && $facture->getDateService() < $promotion->getDateFin()){
                          $rabais = ($service->getTarif() * $promotion->getRabais());
                          echo "<p class='rabais'>- ".number_format($rabais,2)."$</p>";
                        }
                      }
                    }
                  }
                echo "</div>

                <div class='fact-l-5 fact-detail'>
                  <p onclick='cacheDetail(".$i.")'>Réduire</p>
                </div>
              </span>

              <div class='fact-l-6'></div>
            </div>";
            $i += 1;
            $arrService = array();
            $totalFacture = 0;
          }
        }
        else{
          echo "<p class='cata-texte'>Désolé, aucune facture correspond à la recherche.</p>";
        }

        unset($_SESSION['noFacture']);
        unset($_SESSION['nomClient']);
      ?>

    </main>

  </body>
</html>
