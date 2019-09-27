$(document).ready(function(){
  var checkmark = document.getElementById("checkmark");
  checkmark.setAttribute('data-content', "X");
});

function actionCheckmark(){
  if(document.getElementById("checkService").checked == true){
    document.getElementById("checkService").checked = false;
    checkmark.setAttribute('data-content', "");
  }
  else if(document.getElementById("checkService").checked == false){
    document.getElementById("checkService").checked = true;
    checkmark.setAttribute('data-content', "X");
  }
}

function modifier(service){
  console.log(service);
}

//Changer la photo lorsqu'on veut changer
function changeURL(input){
  if(input.files && input.files[0]){
    var reader = new FileReader();

    reader.onload = function(e){
      $('#imgService').attr('src', e.target.result);
    };
    reader.readAsDataURL(input.files[0]);
  }
}

//Verfieir s'il y a deux nombre apres la virgule
function checkZero(){
  var prix = document.getElementById("prix").value;
  var value = Number(prix);
  var result = prix.split(".");

  if(result.length == 1 || result[1].length < 3) {
    // Set the number to two decimal places
        value = value.toFixed(2);
        document.getElementById("prix").value = value;
    }
}

//Valider les champs du formulaire
function validateFormService(){
  var titre = document.getElementById("titre");
  var description = document.getElementById("description");
  var heure = document.getElementById("heure");
  var prix = document.getElementById("prix");

  if(verifieSiVide(titre.value) || verifieSiVide(description.value) || verifieSiVide(heure.value) || verifieSiVide(prix.value)){
    return false;
  }
}

 function verifieTitre(e){
   var titreRegex = /^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._'\s-]*$/;

   if(titreRegex.test(e.value) == false){
     return false;
   }
   return true;
}

function verifieDescription(e){
  var descriptionRegex = /^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._'\s-]*$/;

  if(descriptionRegex.test(e.value) == false){
    return false;
  }
  return true;
}

function verifieDuree(e){
  var descriptionRegex = /^[0-9]{1,4}$/;

  if(descriptionRegex.test(e.value) == false){
    return false;
  }
  return true;
}

function verifiePrix(e){
  var prixRegex = /^[0-9]+$/;

  if(prixRegex.test(e.value) == false){
    return false;
  }
  return true;
}

//Verifie si un champ est vide
  function verifieSiVide(value){
    if(value == null || value == ""){
      return true;
    }
    return false;
}
