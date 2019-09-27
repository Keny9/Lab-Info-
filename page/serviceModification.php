<?php

  require_once('../phpscript/class/classService.php');
  require_once('../phpscript/class/gestionService.php');

  session_start();
  // Si non logged in
  if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
    header("Location:login.php");
  }
  else if($_SESSION['user_administrateur'] == 0){
    header("Location:catalogue.php");
  } //Si administrateur

  $gestionService = new GestionService();

  if(isset($_GET['index'])){
    //Recuperer l'index de l'objet choisi
    $i = $_GET['index'];

    //Obtenir l'objet
    $service = $_SESSION['service'][$i];

    $_SESSION['indexService'] = $_GET['index'];
  }
  else{
    $service = new Service(1,"","","","","","../images/services/cours.gif");
  }

?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/serviceModification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/entete.js"></script>
    <script type="text/javascript" src="../js/serviceModif.js"></script>
    <title>Info++</title>
  </head>
  <body>
    <?php include '../entete/administrateur.php';?>
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
      <form enctype="multipart/form-data" action="../phpscript/ajoutModifService.php" method="post">
        <div class="cours-d">
          <p class="cata-texte text-modif">Vous pouvez modifier les informations du service</p>
          <p class="msgService">Tous les champs sont obligatoires</p>
          <div class="cata-haut">
            <div class="cata-gauche">
              <img id="imgService" src="<?php echo $service->getImage(); ?>" alt="Excel Debutant"><br><br>
            </div>

            <div class="cata-droite">
              <input id="titre" type="text" name="titre" value="<?php echo $service->getTitre(); ?>" class="cata-titre input-td"><br><br>
              <textarea id="description" name="description"><?php echo $service->getDescription(); ?></textarea>
            </div>
          </div>

          <div class="img-update">
            <p class="text-img-u">Mettre à jour la photo</p>
            <div class="camera">
              <label for="file-input"><i class="fa fa-camera"></i></label>
              <input type="file" name="file" id="file-input" onchange="changeURL(this);">
            </div>
          </div>

          <div class="tarif-heure">
            <label class="label-service" for="heure">Durée: (h)</label>
            <input type="text" name="heure" value="<?php echo $service->getDuree(); ?>" id="heure">
            <label class="label-service" for="prix">Prix:</label>
            <input type="text" name="prix" onfocusout="checkZero()" value="<?php echo $service->getTarif(); ?>" id="prix">
          </div>

          <div class="activer-service">
            <input type="checkbox" id="checkService" name="actif-service" value="" checked="checked">
            <span id="checkmark" class="checkmark" onclick="actionCheckmark()"></span>
            <span class="text-activer">Activer le service dans le catalogue</span>
          </div>

          <div class="button-contain">
            <button class="text-button" type="submit" id="ajout-service" name="submit" onclick="return validateFormService()">Confirmer</button>
          </div>

        </div>
      </form>

    </main>
  </body>
</html>
