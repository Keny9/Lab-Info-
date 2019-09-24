//Changer la couleur du lien de la page actuelle
$(document).ready(function() {
  var path = window.location.pathname;
  var page = path.split("/").pop();
  page = page.replace(".php", "");

  if(page == "serviceModification"){
    $("#service").css("color","#FF4A07");
  }
  else{
    $("#" + page).css("color","#FF4A07");
  }

  if(page == "facture"){
    document.getElementById("loupe").disabled = true;
  }

});

$(document).mouseup(function (e) {
      //Cacher la boite de recherche lorsqu'il y a un click a l'exterieur
      if ($(e.target).closest("#boiteRecherche").length === 0) {
          $("#boiteRecherche").hide();
      }
  });

//Affiche la boite de recherche si nous sommes sur la page facture
function afficheRecherche(){
  var path = window.location.pathname;
  var page = path.split("/").pop();
  page = page.replace(".php", "");

  if(page == "facture"){
    $("#boiteRecherche").css("display", "block");
    $("#noFacture").focus();
  }
}
