$(document).ready(function(){
  sousTotal = $("#sousTotal").val() * 1;
  calculMontant();
});

//Recalculer les montants du panier
function calculMontant(){
  tps = Math.round((sousTotal * (5/100))*100)/100;
  tvq = Math.round((sousTotal * (9.975/100))*100)/100;
  total = sousTotal + tps + tvq;

  $("#tvq").text(tvq);
  $("#tps").text(tps);
  $("#total").text(total);
}

function changePanier(idItem){
  qty = $("#qty" + idItem).val() * 1;
  montant = $("#prixArticle" + idItem).val() *1;
  console.log(qty);
  console.log(montant);

  nouveauMontant = Math.round((qty * montant)*100)/100;

  $("#prix" + idItem).text(nouveauMontant);

  sousTotal = sousTotal - montant + nouveauMontant;
  console.log(nouveauMontant);
  console.log(sousTotal);

  calculMontant();
}
