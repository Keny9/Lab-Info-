window.fbAsyncInit = function() {
  FB.init({
    appId      : '511524552961112',
    cookie     : true,
    xfbml      : true,
    version    : 'v4.0'
  });

  FB.AppEvents.logPageView();

};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "https://connect.facebook.net/en_US/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

 function logout(){
   FB.getLoginStatus(function(response){
     if(response.status === 'connected'){
       FB.logout(function(response){
         window.location.href = "../page/login.php";
       });
     }
   });
	}

//Changer la couleur du lien de la page actuelle
$(document).ready(function() {
  var path = window.location.pathname;
  var page = path.split("/").pop();
  page = page.replace(".php", "");

  if(page == "serviceModification" || page == "promotionService"){
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
