<header>
  <div class="entete">
    <img src="../images/icones/logo.png" alt="Logo" id="logo">

    <div class="identification">
      <a class="link" href="login.php">Se déconnecter</a>
    </div>

    <div class="menu">
      <span class="client-group-link"><a id="service" class="client-link" href="service.php">Service</a></span>
      <span class="client-group-link"><a id="promotion" class="client-link" href="#">Promotion</a></span>
      <span class="client-group-link"><a id="facture" class="client-link" href="facture.php">Facture</a></span>

      <form class="form-recherche" action="../phpscript/rechercheAdmin.php" method="post">
        <input id="recherche" type="text" name="recherche" value="" onclick="afficheRecherche()" autocomplete="off">
        <button id="loupe" class="bouton_recherche" type="submit" name="button" formaction="../phpscript/rechercheAdmin.php"><img src="../images/icones/loupe.png" alt="Recherche" onclick="afficheRecherche()"></button>
        <div class="boite_recherche" id="boiteRecherche">
          <input type="text" name="noFacture" value="" placeholder="Numéro de facture" id="noFacture">
          <input type="text" name="nomClient" value="" placeholder="Nom du client">
          <input type="text" name="service" value="" placeholder="Service">
          <button type="submit" name="button"><img src="../images/icones/loupe.png" alt="Recherche"></button>
        </div>
      </form>
    </div>

  </div>
</header>
