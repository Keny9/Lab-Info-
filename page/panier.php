<?php
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/classService.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/promotion.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/AppMedia/phpscript/class/gestionPromotion.php');
  session_start();

  if(isset($_SESSION['panier'])){
    $panier = $_SESSION['panier'];
    //print_r($_SESSION['panier']);
  }

  // Si non logged in
  if (!(isset($_SESSION['user_courriel']) && $_SESSION['user_courriel'] != '')) {
    header("Location: login.php");
  }
  else if($_SESSION['user_administrateur'] == 1){
    header("Location:service.php");
  } //Si administrateur

  $gestionPromotion = new GestionPromotion();

  $sousTotal = 0;

 ?>

 <!DOCTYPE html>
 <html lang="fr" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta http-equiv="X-UA-Compatible" content="IE=edge" />
     <link rel="stylesheet" href="../css/style.css">
     <link rel="stylesheet" href="../css/panier.css">
     <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
     <script type="text/javascript" src="../js/entete.js"></script>
     <script type="text/javascript" src="../js/panier.js"></script>
     <title>Mon panier</title>
   </head>
   <body>
     <?php
      $PAYPAL_CLIENT_ID = "AXRBauMtQKuMpnI7fiFEqtequWz9RU9g7UzKsDbJzJdPOuGDYrSVRfsssN84ezmj14S29xvtLj5UZGq6";
      ?>
     <script src="https://www.paypal.com/sdk/js?client-id=<?php echo $PAYPAL_CLIENT_ID ?>"></script>
     <?php include "../entete/client.php";?>

     <main>
       <div class="cours-d">
         <p class="titre-panier">Mon panier</p>
         <span>Prix</span>
         <hr>
         <?php
         if(isset($_SESSION['panier'])){


          foreach ($panier as $item){
            $arrPromotion = $gestionPromotion->getPromotionOfService($item->getId());
            echo "<div class='article' id='article".$item->getId()."'>
              <span class='article-1 titre-article'>".$item->getTitre()."</span>
              <span><label for='qty'>Qty : </label></span>
              <span class='qty'><input type='number' name='qty' value='".$item->getQty()."' min='0' id='qty".$item->getId()."' onchange='changePanier(".$item->getId().");'></span>
              <span id='prix".$item->getId()."' class='prix'>".number_format($item->getTarif() * $item->getQty(),2)."$</span>
              <input type='hidden' name='prixArticle' value='".$item->getTarif()."' id='prixArticle".$item->getId()."'>
            </div>";
            $sousTotal += ($item->getTarif() * $item->getQty());

              if($arrPromotion != null){
                echo "<div id='promotion".$item->getId()."'>";
                foreach($arrPromotion as $promotion){
                  $rabais = (($item->getTarif() * $item->getQty()) * $promotion->getRabais());
                  echo "<input type='hidden' name='prixArticle' value='".$item->getTarif()."' id='prixArticle".$item->getId()."'>";
                  $sousTotal -= number_format($rabais,2);
                  echo" <div class='article promotion".$item->getId()."'>
                    <span class='article-1 promo'>".$promotion->getTitre()."</span>
                    <span class='prix prix-promo'>-".number_format($rabais,2)."$</span>
                    <input type='hidden' name='prixArticle' class='rabaisPromo' value='".$promotion->getRabais()."' id='prixPromo".$promotion->getId()."'>
                  </div>";
                }
                echo "</div>";
              }
              echo "<hr>";
          }

            echo "<input type='hidden' id='sousTotal' name='sousTotal' value='".$sousTotal."'>";
          }
          ?>

          <?php
            $tps = $sousTotal * (5/100);
            $tvq = $sousTotal * (9.975/100);
            $total = $sousTotal + $tps + $tvq;
          ?>

          <div class="article">
            <span class="article-1 promo"></span>
            <span class="montant">TPS: <span id="tps"><?php echo $_SESSION['tps']?></span>$</span>
          </div>
          <div class="article">
            <span class="article-1 promo"></span>
            <span class="montant">TVQ: <span id="tvq"><?php echo $_SESSION['tvq']?></span>$</span>
          </div>
          <hr>
          <div class="article">
            <span class="article-1 promo"></span>
            <span class="montant">Total: <span id="total"><?php echo $_SESSION['total']; ?></span>$</span>
          </div>
       </div>

       <div id="ppaall">
         <div id="paypal-button-container"></div>
       </div>

     </main>

   </body>
 </html>
