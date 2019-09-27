<?php
  require_once('../phpscript/class/gestionPromotion.php');

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

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/f2db06ef8d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/serviceModification.css">
    <link rel="stylesheet" href="../css/promotionService.css">
    <script type="text/javascript" src="../js/entete.js"></script>
    <script type="text/javascript" src="../js/promoService.js"></script>
    <title>Promotions du service</title>
  </head>
  <body>
    <?php include '../entete/administrateur.php'?>

    <main>
      <div class="cours-d">

        <p class="cata-texte text-modif">Ajouter la période et un code pour appliquer la promotion choisie</p>
        <p class="msgService">Le code n'est pas obligatoire et ne sera pas exigé si le champ est vide.</p>
        <form action="" method="post">
          <div class="promo-haut">
            <div id="box" class="box">
              <select id="selectPromo" onmouseover="changeToOrangeColor()" onmouseout="changeToWhiteColor()" name="promotion">
                <?php
                  foreach($arrPromotion as $promotion){
                    echo "<option value='".$promotion->getId()."'>".$promotion->getTitre()."</option>";
                  }
                ?>
              </select>
            </div>

            <label for="rabais">Rabais:</label>
            <input type="text" name="rabais" value="<?php  ?>">
          </div>

          <div class="promo-milieu">
            <p class="cata-texte text-modif">Période de la promotion</p>
            <div class="date">
              <input id="startDate" type="date" name="startDate" value="">
              <input id="endDate" type="date" name="endDate" value="">
            </div>
          </div>

          <div class="code">
            <p class="cata-texte text-modif">Entrer un code s'il est requis pour appliquer la promotion lors de la création de la facture.</p>
            <input type="text" id="code" name="code" value="">
          </div>

          <div class="button-contain">
            <button class="text-button" type="submit" id="ajout-service" name="submit" onclick="return validateFormService()">Confirmer</button>
          </div>

        </form>
      </div>
    </main>

  </body>
</html>
