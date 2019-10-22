<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/classService.php');
  session_start();

  if(isset($_SESSION['panier'])){
    //print_r($_SESSION['panier']);
  }

  // Si non logged in
  if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
    $header = '../entete/nonConnecter.php';
  }
  else if($_SESSION['user_administrateur'] == 1){
    header("Location:service.php");
  } //Si administrateur

 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/style.css">
     <link rel="stylesheet" href="../css/panier.css">
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
     <script type="text/javascript" src="../js/entete.js"></script>
     <title>Mon panier</title>
   </head>
   <body>
     <?php include "../entete/client.php";?>

     <main>
       <div class="cours-d">
         <p class="titre-panier">Mon panier</p>
         <span>Prix</span>
         <hr>
         <div class="article">
           <span class="article-1 titre-article">Cours excel 2016</span>
           <span><label for="qty">Qty : </label></span>
           <span class="qty"><input type="number" name="qty" value="" min="1"></span>
           <span class="prix">99,99$</span>
         </div>
         <div class="article">
           <span class="article-1 titre-article">Cours excel 2016</span>
           <span><label for="qty">Qty : </label></span>
           <span class="qty"><input type="number" name="qty" value="" min="1"></span>
           <span class="prix">5,99$</span>
         </div>
          <hr>
          <p class="titre-panier">Promotions</p>
          <div class="article">
            <span class="article-1 promo">Cours excel 2016</span>
            <span class="prix prix-promo">-99,99$</span>
          </div>
          <hr>
          <div class="article">
            <span class="article-1 promo"></span>
            <span class="montant">TPS: 4,50$</span>
          </div>
          <div class="article">
            <span class="article-1 promo"></span>
            <span class="montant">TVQ: 5,50$</span>
          </div>
          <hr>
          <div class="article">
            <span class="article-1 promo"></span>
            <span class="montant">Total: 1000,99$</span>
          </div>
       </div>
     </main>

   </body>
 </html>
