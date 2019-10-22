//Ajouter un service dans le panier
function ajoutService(id){
  $.ajax({
    url: '../phpscript/ajoutPanier.php',
    type: 'POST',
    dataType: 'json',
    data: ({id: $('#idService' + id).val()})
  }).done(function(qty){
    $('#qty').html(qty);
  });
}
