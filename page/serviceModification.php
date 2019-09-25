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

    <main>
      <div class="cours-d">
        <p class="cata-texte text-modif">Vous pouvez modifier les informations du service</p>
        <p class="msgService">Tous les champs sont obligatoires</p>
        <div class="cata-haut">
          <div class="cata-gauche">
            <img id="imgService" src="../images/services/coursexcel.png" alt="Excel Debutant"><br><br>
          </div>

          <div class="cata-droite">
            <input id="titre" type="text" name="titre" value="Excel débutant" class="cata-titre input-td"><br><br>
            <textarea id="description" name="description">Ce cours a pour objectif de vous initier au chiffrier Excel, pour vous permettre de créer des classeurs et de les mettre en forme professionnellement.</textarea>
          </div>
        </div>

        <div class="img-update">
          <p class="text-img-u">Mettre à jour la photo</p>
          <div class="camera"><i class="fa fa-camera"></i></div>
        </div>

        <div class="tarif-heure">
          <label for="heure">Durée: (h)</label>
          <input type="text" name="heure" value="25" id="heure">
          <label for="prix">Prix:</label>
          <input type="text" name="prix" value="200" id="prix">
        </div>

        <div class="activer-service">
          <input type="checkbox" id="checkService" name="actif-service" value="" checked="checked">
          <span id="checkmark" class="checkmark" onclick="actionCheckmark()"></span>
          <span class="text-activer">Activer le service dans le catalogue</span>
        </div>

        <div class="button-contain">
          <button class="text-button" type="button" id="ajout-service">Confirmer</button>
        </div>

      </div>
    </main>
  </body>
</html>
