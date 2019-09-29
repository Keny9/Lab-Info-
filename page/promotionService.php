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

  if(isset($_GET['idPromo'])){ //mode update id de la table d'association service_promo
    $id = $_GET['idPromo'];
    $promotionOfService = $gestionPromotion->getPromotion($id);
    $_SESSION['idPromo'] = $promotionOfService->getIdPromoService();
    $update = true;
  }
  else{ //mode ajout
    $promotionOfService = new Promotion(1,"","","","","","","","",$_GET['id']);
    $update = false;
  }

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
    <?php
      if(isset($_SESSION['error'])){
        echo "<div class='error'>
                <p>".$_SESSION['errorMsg'].
              "</div>";

        unset($_SESSION['error']);
        unset($_SESSION['errorMsg']);
      }
     ?>
    <main>
      <div class="cours-d">

        <p class="cata-texte text-modif">Ajouter la période et un code pour appliquer la promotion choisie</p>
        <p class="msgService">Le code n'est pas obligatoire et ne sera pas exigé si le champ est vide.</p>
        <form action="../phpscript/ajoutPromoService.php?id=<?php echo $_GET['id']; ?>" method="post">
          <div class="promo-haut">
            <div id="box" class="box">
              <select id="selectPromo" onmouseover="changeToOrangeColor()" onmouseout="changeToWhiteColor()" name="promotion[]" onchange="changeFunc();">
                <?php
                  if($update == false){
                    echo "<option id='optionVide' value='vide' selected='selected'></option>";
                  }
                  foreach($arrPromotion as $promotion){
                    if($update == true){
                      if($promotion->getId() == $promotionOfService->getId()){
                        echo "<option value='".$promotion->getId()."' selected='selected'>".$promotion->getTitre()."</option>";
                      }
                      else{
                        echo "<option value='".$promotion->getId()."'>".$promotion->getTitre()."</option>";
                      }
                    }
                    else{
                      echo "<option value='".$promotion->getId()."'>".$promotion->getTitre()."</option>";
                    }
                  }
                ?>
              </select>
            </div>

            <label for="rabais">Rabais:</label>
            <?php
              if($update == true){
                $rabais = $promotionOfService->getRabais() * 100;
                $rabaisTxt = $rabais . " %";
                echo "<input type='text' name='rabais' id='rabais' value='".$rabaisTxt."' required>";
              }
              else{
                echo "<input type='text' name='rabais' id='rabais' value='' required>";
              }
            ?>

          </div>

          <div class="promo-milieu">
            <p class="cata-texte text-modif">Période de la promotion</p>
            <div class="date">
              <?php
                if($update == true){
                  echo "<input id='startDate' type='date' name='startDate' value='".$promotionOfService->getDateDebut()."' placeholder='Date de début' required>
                        <input id='endDate' type='date' name='endDate' value='".$promotionOfService->getDateFin()."' placeholder='Date de fin' required>";
                }
                else{
                  echo "<input id='startDate' type='date' name='startDate' value='' placeholder='Date de début' required>
                        <input id='endDate' type='date' name='endDate' value='' placeholder='Date de fin' required>";
                }

              ?>

            </div>
          </div>

          <div class="code">
            <p class="cata-texte text-modif">Entrer un code s'il est requis pour appliquer la promotion lors de la création de la facture.</p>
            <?php
              if($update == true){
                echo "<input type='text' id='code' name='code' value='".$promotionOfService->getCode()."'>";
              }
              else{
                echo "<input type='text' id='code' name='code' value=''>";
              }
            ?>
          </div>

          <div class="button-contain">
            <button class="text-button" type="submit" id="ajout-service" name="submit" onclick="return validateFormService()">Confirmer</button>
          </div>

        </form>
      </div>
    </main>

  </body>
</html>
