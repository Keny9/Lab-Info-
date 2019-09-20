<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>

    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <header>
      <?php  include '../entete/nonConnecter.php'?>
    </header>
    <main>
      <form class="form_register" action="" method="post">
        <div class="col-12">
          <p class="black_p">Remplissez ce formulaire pour créer votre profil</p>
          <p class="red_p">Tous les champs sont obligatoires</p>
          <div class="input_block col-12">
            <div class="input col-6">
              <input type="text" id="nom" placeholder="Nom" value="">
            </div>
            <div class="input col-6">
              <input type="text" id="prenom" placeholder="Prénom" value="">
            </div>

            <div class="input col-2">
              <input type="text" id="no" placeholder="No civic" value="">
            </div>
            <div class="input col-4">
              <input type="text" id="rue" placeholder="Rue" value="">
            </div>
            <div class="input col-6">
              <input type="text" id="ville" placeholder="Ville" value="">
            </div>
          </div>
          <p class="black_p">Votre courriel servira à vous identifier lors de votre prochaine visite</p>
          <p class="red_p">Le mot de passe doit avoit au moins 1 chiffre, 1 lettre et 8 caractères minimum</p>
          <div class="col-12">
            <div class="input col-6">
              <input type="text" id="courriel" placeholder="Courriel" value="">
            </div>
            <div class="input col-6">
              <input type="text" id="confirmation_courriel" placeholder="Confirmation du courriel" value="">
            </div>

            <div class="input col-6">
              <input type="text" id="password" placeholder="Mot de passe" value="">
            </div>
            <div class="input col-6">
              <input type="text" id="confirmation_password" placeholder="Confirmation du mot de passe" value="">
            </div>
            <input type="checkbox" name="prom" id="prom" checked="checked"value=""> <label for="prom">Souhaitez-vous recevoir les promotions et les nouveautés</label>
          </div>
        </div>
        <button type="button" name="button">Confirmer</button>
      </form>
    </main>
    <footer>

    </footer>
  </body>
</html>
