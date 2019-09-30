
$(document).ready(function() {


  //Confirmer la validation du formulaire
  $('#confirmer').click(function(){
    // Si tous les champs 'required' sont remplis
    if ($('#formulaire')[0].checkValidity()) {
      if(valider_le_tout()){
        $('#formulaire').submit();
      }

    }
    else{
      alert("Veuillez remplir tout les champs");
    }
  });
});

function valider_le_tout(){
  var url = window.location.pathname;
  var filename = url.substring(url.lastIndexOf('/')+1);

  var nom = $('#nom').val();
  var prenom = $('#prenom').val();
  var no_civique = $('#no').val();
  var rue = $('#rue').val();
  var ville = $('#ville').val();
  var code_postal = $('#code_postal').val();
  var telephone = $('#telephone').val();
  var courriel = $('#courriel').val();
  var confirmation_courriel = $('#confirmation_courriel').val();
  var password = $('#password').val();
  var confirmation_password = $('#confirmation_password').val();
  var prom = $('#prom').val();
  var confirmer = $('#confirmer');
  var formulaire = $('#formulaire');



  if(!validerCodePostal()){alert("Le code postal doit respecter le format j1n 1x1 ou j1n-1x1"); return false;}
  if(!validerTelephone()){alert("Le numéro de téléphone est invalide. Entrer le dans le format 819 123 4567 ou 1 819 123 4567."); return false;}
  if(!validerCourriel()){alert("Le format de courriel est invalide."); return false;}

  // Si c'est une modification
  if(filename == "profil.php"){
  //  $('#formulaire').attr('action', '../phpscript/update_profil.php');
    var temp = 0;
    if($('#confirmation_courriel').val()){
      if(courrielExistant()){alert("Le courriel existe déjà. Veuillez en choisir un nouveau."); return false;}
      if(!validerCourrielIdentique()){alert("Les adresses courriels ne sont pas identiques."); return false;}
      temp = 1;
    }
    if($('#password').val()){
      if(!validerMotDePasse()){alert("Le mot de passe doit répondre aux critères suivant : 8 caractères minimum avec au moins un caractère alphabétique et un caractère numérique"); return false;}
      if(!validerMotDePasseIdentique()){alert("Les mots de passe ne sont pas identiques"); return false;}
      if (temp == 1){temp = 3;}
      else {temp = 2;}
    }
    if(temp == 0) {$('#formulaire').attr('action', '../phpscript/update_profil.php'); alert("temp 0");}
    else if (temp == 1) {$('#formulaire').attr('action', '../phpscript/update_profil_courriel.php'); alert("temp 1");}
    else if (temp == 2) {$('#formulaire').attr('action', '../phpscript/update_profil_password.php'); alert("temp 2");}
    else if (temp == 3) {$('#formulaire').attr('action', '../phpscript/update_profil_courriel_password.php'); alert("temp 3");}
  }
  // Si c'est une inscription
  else if(filename == "register.php"){
    $('#formulaire').attr('action', '../phpscript/inscription.php');

    if(courrielExistant()){alert("Le courriel existe déjà. Veuillez en choisir un nouveau."); return false;}
    if(!validerMotDePasse()){alert("Le mot de passe doit répondre aux critères suivant : 8 caractères minimum avec au moins un caractère alphabétique et un caractère numérique"); return false;}
    if(!validerCourrielIdentique()){alert("Les adresses courriels ne sont pas identiques."); return false;}
    if(!validerMotDePasseIdentique()){alert("Les mots de passe ne sont pas identiques"); return false;}
  }

  return true;
}


//Compare deux paramètres. Retourne vrai s'ils sont identique
function identique(param1, param2){
  if(param1 == param2){return true;}
  else {return false;}
}

function validerCourrielIdentique(){
  if(identique($('#courriel').val(), $('#confirmation_courriel').val())){return true;}
  else {return false;}
}

function validerCourriel(){
  var regex = new RegExp("^\\w+([\\.-]?\\w+)*@\\w+([\\.-]?\\w+)*(\\.\\w{2,3})+$");

  if (regex.test($('#courriel').val())) {return true;}
  else {return false;}
}

function courrielExistant(){
  var bool = true;
  $.ajax({
    type: "POST",
    async: false,
    url: "../phpscript/courriel_existant.php",
    data: {"courriel": $('#courriel').val()},
    success: function(result){
      alert(result);
      if(result == '1'){
        bool = false;
      }
    },
    error: function(error){
      alert('error occured : ' + error);
    }
  });
  return bool;
}

function validerMotDePasseIdentique(){
  if(identique($('#password').val(), $('#confirmation_password').val())){return true;}
  else{return false;}
}

function validerMotDePasse(){
  var regex = new RegExp("^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]{8,})$");

  if (regex.test($('#password').val())) {return true;}
  else {return false;}
}

function validerCodePostal(){
  var regex = new RegExp("^[a-zA-Z][0-9][a-zA-Z][ -]{0,1}[0-9][a-zA-Z][0-9]$");

  if (regex.test($('#code_postal').val())) {return true;}
  else {return false;}
}

function validerTelephone(){
  var regex = new RegExp("^([1][ -]{0,1}){0,1}([(]{0,1}[0-9]{3}[)]{0,1})[ -]{0,1}[0-9]{3}[ -]{0,1}[0-9]{4}$");

  if (regex.test($('#telephone').val())) {return true;}
  else {return false;}
}

function inscrire(){
  var bool = true;
  if (courriel == $('#courriel').val()){
    bool = false;
  }
  else{
    $.ajax({
      type: "POST",
      async: false,
      url: "../phpscript/inscription.php",
      data: {"courriel": $('#courriel').val()},
      success: function(result){
        alert(result);
        if(result == '1'){
          bool = false;
        }
      },
      error: function(error){
        alert('error occured : ' + error);
      }
    });
  }
  return bool;
}
