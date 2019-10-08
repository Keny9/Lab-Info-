<header>
  <div class="entete">
    <img src="../images/icones/logo.png" alt="Logo" id="logo">

    <div class="identification">
      <a class="link" href="construction.php">Mon panier (0)</a>
      <?php
        if(isset($_SESSION['facebook_login']) && $_SESSION['facebook_login'] == 1){
          echo "<a class='link' href='login.php' onclick='logout();' id='disconnect'>Se déconnecter</a>";
        }
        else{
          echo "<a class='link' href='login.php' id='disconnect'>Se déconnecter</a>";
        }
       ?>
    </div>

    <div class="menu">
      <span class="client-group-link"><a id="catalogue" class="client-link" href="catalogue.php">Catalogue</a></span>
      <span class="client-group-link"><a id="profil" class="client-link" href="profil.php">Profil</a></span>

      <form class="form-recherche" action="../page/catalogue.php" method="post">
        <input id="recherche" type="text" name="recherche" value="">
        <button class="bouton_recherche" type="submit" name="button"><img src="../images/icones/loupe.png" alt="Recherche"></button>
      </form>
    </div>

  </div>
</header>
