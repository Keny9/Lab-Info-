$(document).ready(function(){
  sousTotal = $("#sousTotal").val() * 1;
  generatePaypal();
});

//Generer le bouton paypal
function generatePaypal(){
  var totalPrice = jQuery('#total').html().replace(',', '.');
  paypal.Buttons({
    createOrder: function(data, actions) {
      //Set up transaction
      return actions.order.create({
        purchase_units : [{
          amount: {
            value: totalPrice
          }
        }]
      });
    }
  }).render('#paypal-button-container');
}

//Recalculer les montants du panier
function calculMontant(){
  tps = Math.round((sousTotal * (5/100))*100)/100;
  tvq = Math.round((sousTotal * (9.975/100))*100)/100;
  total = Math.round((sousTotal + tps + tvq)*100)/100;

  $("#tvq").text(tvq.toFixed(2));
  $("#tps").text(tps.toFixed(2));
  $("#total").text(total.toFixed(2));
}

function changePanier(idItem){
  var valuePromo = []; //Valeur initiale des rabais
  qty = $("#qty" + idItem).val() * 1;
  montant = $("#prixArticle" + idItem).val() *1;

  nouveauMontant = (qty * montant);
  sousTotal = sousTotal - parseInt($("#prix" + idItem).text())  + nouveauMontant;

  $(".promotion" + idItem).children("input.rabaisPromo").each(function(){
    valuePromo.push($(this).val());
  });

  $(".promotion" + idItem).children("span.prix-promo").each(function(index){
    rabais = valuePromo[index] * parseInt($("#prix" + idItem).text());
    nouveauRabais = valuePromo[index] * nouveauMontant;

    sousTotal = sousTotal + rabais - nouveauRabais;

    $(this).text("-" + (nouveauRabais).toFixed(2) + "$");
  });

  $("#prix" + idItem).text((nouveauMontant.toFixed(2) + "$"));

  tps = (sousTotal * (5/100));
  tvq = (sousTotal * (9.975/100));
  total = (sousTotal + tps + tvq);

  tps = (Math.round( tps * 100 ) / 100).toFixed(2);
  tvq = (Math.round( tvq * 100 ) / 100).toFixed(2);
  total = (Math.round( total * 100 ) / 100).toFixed(2);

  $("#tvq").text(tvq);
  $("#tps").text(tps);
  $("#total").text(total);

  $.ajax({ //Changer la session... À FAIRE
    type: "POST",
    url: "../phpscript/updateSession.php",
    data: {id: idItem, qty: qty, sousTotal: sousTotal.toFixed(2), tps: tps, tvq: tvq, total: total},
    success: function(response){
      console.log(response);
    }
  });

  jQuery("#paypal-button-container").remove();
  jQuery("#ppaall").append("<div id=\"paypal-button-container\"></div>");
  generatePaypal();

  if(qty == 0){
    deleteItem(idItem);
  }
}

//Supprimer un element du panier
function deleteItem(idItem){
  $("#article" + idItem).remove();
  $("#promotion" + idItem).remove();
  console.log("Remove item");
}
