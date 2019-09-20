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
});
