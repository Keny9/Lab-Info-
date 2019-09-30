<?php
session_start();
//Si un utilisateur était précédemment connecté
if((isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')){
  session_destroy();
  session_start();
}
 ?>
 <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Authentification</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/login.js"></script>
  </head>

  <body>
    <?php include '../entete/nonConnecter.php'; ?>

    <div class="modal" id="modal">
      <div class="modal-content">
        <span id="modal-close"class="close">X</span>
        <br><br>
        <p class="vingt_six_px">
          Inscrivez votre courriel pour envoyer une demande de mot de passe oublié.
        </p>
        <input type="text" id="emailOublie" placeholder="Courriel">
        <button class="vingt_six_px center" type="button" id="confirmerOublie">Confirmer</button>
        <br>
      </div>
      <img id="loading-image" src="../images/mickey.gif" alt="mickeymouse">
    </div>




    <main>
      <div class="block-login">
        <p class="vingt_six_px">
          Veuillez vous identifier pour avoir la possibilité d'acheter des formations
        </p>

        <input type="text" id="email" placeholder="Courriel">
        <input type="password" id="password" placeholder="Mot de passe">
        <div class="left_align">
        <a class="forgot" id="forgot">Mot de passe oublié</a>

          <div class="buttons">
            <div class="login_contain">
              <button class="vingt_six_px" type="button" id="login">Connexion</button>
            </div>

            <div class="register_contain">
              <button class="vingt_six_px" type="button" href="register.php" id="register">S'inscrire</button>
            </div>


          </div>

          <div class="">
            <!-- login with facebook -->
          </div>
        </div>
      </div>
    </main>

    <footer>

    </footer>
  </body>
</html>
