<?php
  require_once("../phpscript/class/gestionPromotion.php");
  require_once("../phpscript/class/promotion.php");

  session_start();
  // Si non logged in
  if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
    header("Location:login.php");
  }
  else if($_SESSION['user_administrateur'] == 0){
    header("Location:catalogue.php");
  } //Si administrateur

  $gestionPromotion = new GestionPromotion();
  $arrPromotion = $gestionPromotion->getAllPromotion();

  $i = 0; //iteration pour les id de chaque promotions

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/serviceModification.css">
    <link rel="stylesheet" href="../css/promotion.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/entete.js"></script>
    <script type="text/javascript" src="../js/promotion.js"></script>
    <title>Promotion</title>
  </head>
  <?php include("../entete/administrateur.php"); ?>
  <body>

    <main>
      <a class="link-service" id="link-ajout-promo" onclick='ajoutPromo()'>Ajouter une promotion</a>
      <form action="../phpscript/ajoutModifPromo.php" method="post">
        <div class="cours-d">
          <?php
            foreach($arrPromotion as $promotion){ //Afficher toutes les promotions
              echo "<div class='promotion-block' onclick='promotionSelected(this,".$i.");' id='block".$i."'>
                <span id='nomSelect".$i."' class='titre-promo'>".$promotion->getTitre()."</span>
                <span id='rabaisSelect".$i."' class='rabais-promo'>".$promotion->getRabais() * 100 ." %</span>
              </div>";
              $i++;
            }
          ?>
          </div>
          <p class="msg-input">Ajouter ou modifier une promotion</p>
          <div class="cours-d">
            <div class="input-promotion">
              <input id="input-nom" class="input-nomPromo" type="text" name="nomPromo" value="">
              <input id="input-rabais" class="input-rabaisPromo" type="text" name="rabaisPromo" value="" maxlength="2" onfocusout="">
              <input type="hidden" id="mode" name="mode" value="add">
              <input type="hidden" name="idPromotion" id="idPromotion" value="">
              <div class="button-contain">
                <button class="text-button" type="submit" id="ajout-promo" name="submit" onclick="return validateFormPromotion()">Confirmer</button>
              </div>
            </div>
          </div>
      </form>

    </main>

  </body>
</html>
