//Lors d'un clic dans la liste des promos on met a jour les données
function promotionSelected(block,id){
  var request = new XMLHttpRequest();
  var method = "POST";
  var url = "../phpscript/dataPromo.php";

  clearSelection();

  block.style.backgroundColor = '#09AAC1';

  document.getElementById("mode").value = "update";

  request.open(method, url, true);
  request.send();

  request.onreadystatechange = function(){

    if(this.readyState == 4 && this.status == 200){
      var data = JSON.parse(this.responseText);
      //console.log(data); //For debugging

      nomPromo = document.getElementById("nomSelect" + id).innerText;
      rabaisPromo = document.getElementById("rabaisSelect" + id).innerText;

      for(var i = 0; i < data.length; i++){
        if(data[i].promotion_titre == nomPromo){
          document.getElementById("input-nom").value = data[i].promotion_titre;
          document.getElementById("input-rabais").value = data[i].rabais * 100;
          document.getElementById("idPromotion").value = data[i].pk_promotion;
        }
      }

    }
  };
}

//Enleve la selection de la promotion
function clearSelection(){
  divs = document.getElementsByClassName("promotion-block");
  for(i = 0; i < divs.length; i++){
    divs[i].style.backgroundColor = 'transparent';
  }
}

//Une promo est en ajout
function ajoutPromo(){
  clearSelection();
  document.getElementById("input-nom").value = "";
  document.getElementById("input-rabais"). value = "";
  document.getElementById("input-nom").focus();
  document.getElementById("mode").value = "add";
  document.getElementById("idPromotion").value = "";
}

//Faire une fonction qui ajuste le rabais. ex: 0.40 en 40
