$(document).ready(function() {
  $('#login').click(function() {
    if($('#email').val() == ""){
      alert("Veuillez entrer votre adresse courriel.");
      return;
    }
    if($('#password').val() == ""){
      alert("Veuillez entrer votre mot de passe");
      return;
    }

    $.ajax({
      type: "POST",
      url: "../phpscript/verify_login.php",
      data: {
        "email": $('#email').val(),
        "password": $('#password').val()},
      success: function(result){
        if(result == '01'){
          alert('Aucun résultat');
        }
        else{
          window.location = result;
        }

      },
      error: function(error){
        alert('error occured : ' + error);
      }
    });
  });

  $('#register').click(function(){
    window.location.href = "register.php";
  });

  $('#modal-close').click(function(){
    $('#modal').css("display", "none");
  });

  $('#forgot').click(function(){
    $('#modal').css("display", "block");
  });

  $('#confirmerOublie').click(function(){
    motDePasseOublie();

  });


});

function motDePasseOublie(){
  if(!courrielExistant()){
    alert("Le courriel entré ne se trouve pas dans notre banque de courriel.");
  }
  else{
    envoyeCourriel();

  }
}

function envoyeCourriel(){
  $('#loading-image').css("display", "block");
  $.ajax({
    type: "POST",
    async: true,
    url: "../phpscript/envoye_courriel.php",
    data: {"courriel": $('#emailOublie').val()},
    success: function(result){
      alert(result + "Un courriel a été envoyé à l'adresse courriel " + $('#emailOublie').val());
      $('#modal').css("display", "none");
    },
    error: function(error){
      alert('error occured : ' + error);
    },
    complete: function(){
      $('#loading-image').css("display", "none");
    }
  });
}

function courrielExistant(){
  var bool = true;
  $.ajax({
    type: "POST",
    async: false,
    url: "../phpscript/courriel_existant.php",
    data: {"courriel": $('#emailOublie').val()},
    success: function(result){
    //  alert(result);
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
