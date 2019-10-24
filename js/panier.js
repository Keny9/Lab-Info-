$(document).ready(function(){
  sousTotal = $("#sousTotal").val() * 1;
  calculMontant();
});

//Recalculer les montants du panier
function calculMontant(){
  tps = (sousTotal * (5/100));
  tvq = (sousTotal * (9.975/100));
  total = (sousTotal + tps + tvq);

  $("#tvq").text(Math.round(tvq *100)/100);
  $("#tps").text(Math.round(tps *100)/100);
  $("#total").text(Math.round(total *100)/100);
}

function changePanier(idItem){
  var valuePromo = []; //Valeur initiale des rabais
  qty = $("#qty" + idItem).val() * 1;
  montant = $("#prixArticle" + idItem).val() *1;

  nouveauMontant = (qty * montant);
  sousTotal = sousTotal - parseInt($("#prix" + idItem).text())  + nouveauMontant;

  $(".promotion" + idItem).children("input.rabaisPromo").each(function(){
    console.log($(this).val());
    valuePromo.push($(this).val());
  });

  $(".promotion" + idItem).children("span.prix-promo").each(function(index){
    rabais = valuePromo[index] * parseInt($("#prix" + idItem).text());
    nouveauRabais = valuePromo[index] * nouveauMontant;

    sousTotal = sousTotal + rabais - nouveauRabais;

    $(this).text("-" + (nouveauRabais).toFixed(2) + "$");
  });

  $("#prix" + idItem).text((nouveauMontant.toFixed(2) + "$"));

  console.log("Montant: " + montant);
  console.log("Nouveau montant:" + nouveauMontant);
  console.log("Sous-total:" + sousTotal);

  calculMontant();
}
