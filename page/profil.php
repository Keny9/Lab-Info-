<?php
session_start();
// Si l'utilisateur n'est pas connecté
if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
  header("Location:login.php");
}
else if($_SESSION['user_administrateur'] == 0)
// Est un client
{
  $nom = $_SESSION['nom'];
  $prenom = $_SESSION['prenom'];
  $telephone = $_SESSION['telephone'];
  $no_civique = $_SESSION['no_civique'];
  $rue = $_SESSION['rue'];
  $ville = $_SESSION['ville'];
  $courriel = $_SESSION['user_courriel'];
  $password = $_SESSION['user_motDePasse'];
  $infolettre = 1;//$_SESSION['infolettre'];
  $code_postal = $_SESSION['code_postal'];
}
else // est un admin
{
  // Revien à la page précédente
  echo '<script type="text/javascript">',
  'javascript:history.go(-1);',
  '</script>';
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Inscription</title>

    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <link rel="stylesheet" href="../css/style.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="../js/register.js"></script>
    <script type="text/javascript" src="../js/entete.js"></script>
  </head>
  <body>
    <header>
      <?php  include '../entete/client.php'?>
    </header>
    <main>
      <form class="form_register" id="formulaire" action="" method="post">
        <div class="col-12">
          <p class="black_p">Vous pouvez modifier les informations de votre profil</p>
          <p class="red_p">Tous les champs sont obligatoires</p>
          <div class="input_block col-12">
            <div class="input col-6">
              <input type="text" id="nom" name="nom" placeholder="Nom" value="<?php Print($nom) ?>" required>
            </div>
            <div class="input col-6">
              <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?php Print($prenom) ?>" required>
            </div>

            <div class="input col-2">
              <input type="text" id="no" name="no" placeholder="No civic" value="<?php Print($no_civique) ?>" required>
            </div>
            <div class="input col-4">
              <input type="text" id="rue" name="rue" placeholder="Rue" value="<?php Print($rue) ?>" required>
            </div>
            <div class="input col-6">
              <select class="" id="ville" name="ville" value="<?php Print($ville) ?>" required>
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
            <div class="col-12">
              <!-- dans un div col-12. Sinon, l'alignement des deux inputs ne se fait pas correctement -->
              <div class="input col-6">
                <input type="text" id="code_postal" name="code_postal" placeholder="Code Postal" value="<?php Print($code_postal) ?>" required>
              </div>
              <div class="input col-6">
                <input type="text" id="telephone" name="telephone" placeholder="Numéro de téléphone" value="<?php Print($telephone) ?>" required>
              </div>
            </div>

          </div>
          <p class="black_p">Votre courriel servira à vous identifier lors de votre prochaine visite</p>
          <p class="red_p">Le mot de passe doit avoit au moins 1 chiffre, 1 lettre et 8 caractères minimum</p>
          <div class="col-12">
            <div class="input col-6">
              <input type="text" id="courriel" name="courriel" placeholder="Courriel" value="<?php Print($courriel) ?>" required>
            </div>
            <div class="input col-6">
              <input type="text" id="confirmation_courriel" placeholder="Confirmation du courriel" value="">
            </div>

            <div class="input col-6">
              <input type="text" id="password" name="password" placeholder="Mot de passe" value="">
            </div>
            <div class="input col-6">
              <input type="text" id="confirmation_password" placeholder="Confirmation du mot de passe" value="">
            </div>
            <input type="checkbox" name="prom" id="prom" checked="checked"value=""> <label for="prom">Souhaitez-vous recevoir les promotions et les nouveautés</label>
          </div>
        </div>
        <button type="button" id="confirmer">Confirmer</button>
      </form>
    </main>
    <footer>

    </footer>
  </body>

</html>
