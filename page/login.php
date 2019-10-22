<?php
session_start();
$_SESSION['qty'] = 0;
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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="../js/login.js"></script>
  </head>

  <body>
    <script type="text/javascript" src="../js/facebookLogin.js"></script>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v4.0&appId=511524552961112&autoLogAppEvents=1"></script>
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
        </div>

        <div class="">
          <fb:login-button class="fb-login-button" data-width="" data-size="large" data-button-type="login_with" data-auto-logout-link="false" data-use-continue-as="false" scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
        </div>

        <div id="status"></div>

      </div>
    </main>

    <footer>

    </footer>
  </body>
</html>
