<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>

    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <link rel="stylesheet" href="../css/style.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/register.js"></script>
  </head>
  <body>
    <header>
      <?php  include '../entete/nonConnecter.php'?>
    </header>
    <main>
      <form class="form_register" id="formulaire" action="" method="post">
        <div class="col-12">
          <p class="black_p">Remplissez ce formulaire pour créer votre profil</p>
          <p class="red_p">Tous les champs sont obligatoires</p>
          <div class="input_block col-12">
            <div class="input col-6">
              <input type="text" id="nom" name="nom" placeholder="Nom" value="" required>
            </div>
            <div class="input col-6">
              <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="" required>
            </div>

            <div class="input col-2">
              <input type="text" id="no" name="no" placeholder="No civic" value="" required>
            </div>
            <div class="input col-4">
              <input type="text" id="rue" name="rue" placeholder="Rue" value="" required>
            </div>
            <div class="input col-6">
              <select class="" id="ville" name="ville" placeholder="Ville" required>
                <option value="1">Sherbrooke</option>
                <option value="2">Magog</option>
                <option value="3">Orford</option>
                <option value="4">North Hathley</option>
                <option value="5">Windsor</option>
                <option value="6">Waterville</option>
                <option value="7">Saint-Denis-de-Brompton</option>
                <option value="8">Eastman</option>
                <option value="9">Racine</option>
              </select>
            </div>
            <div class="input col-6">
              <input type="text" id="code_postal" name="code_postal" placeholder="Code Postal" value="" required>
            </div>
            <div class="input col-6">
              <input type="text" id="telephone" name="telephone" placeholder="Numéro de téléphone" value="" required>
            </div>
          </div>
          <p class="black_p">Votre courriel servira à vous identifier lors de votre prochaine visite</p>
          <p class="red_p">Le mot de passe doit avoit au moins 1 chiffre, 1 lettre et 8 caractères minimum</p>
          <div class="col-12">
            <div class="input col-6">
              <input type="text" id="courriel" name="courriel" placeholder="Courriel" value="" required>
            </div>
            <div class="input col-6">
              <input type="text" id="confirmation_courriel" placeholder="Confirmation du courriel" value="" required>
            </div>

            <div class="input col-6">
              <input type="text" id="password" name="password" placeholder="Mot de passe" value="" required>
            </div>
            <div class="input col-6">
              <input type="text" id="confirmation_password" placeholder="Confirmation du mot de passe" value="" required>
            </div>
            <input type="checkbox" name="prom" id="prom" checked="checked"value="1"> <label for="prom">Souhaitez-vous recevoir les promotions et les nouveautés</label>
          </div>
        </div>
        <button type="button" id="confirmer">Confirmer</button>
      </form>
        <span id="metadata-size-of-widget" title="<?php Print($courriel) ?>"></span>
    </main>
    <footer>

    </footer>
  </body>
</html>
