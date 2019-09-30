function changeToOrangeColor(){
  document.getElementById("selectPromo").style.background = "#FF9F07";
  document.getElementById("selectPromo").style.color = "black";
  document.getElementById("box").classList.add('box-color-before');
}

function changeToWhiteColor(){
  document.getElementById("selectPromo").style.background = "white";
  document.getElementById("selectPromo").style.color = "#FF9F07";
  document.getElementById("box").classList.remove('box-color-before');
}

//Lorsqu'une promotion est sélectionné, on remplit les champs automatiquement
//Utilisation de Ajax
function changeFunc(){
  var request = new XMLHttpRequest();
  var method = "POST";
  var url = "../phpscript/dataPromo.php";

  request.open(method, url, true);
  request.send();

  request.onreadystatechange = function(){

    if(this.readyState == 4 && this.status == 200){
      var data = JSON.parse(this.responseText);
      console.log(data); //For debugging

      var list = document.getElementById("selectPromo");
      var value = list.options[list.selectedIndex].value;

      for(var i = 0; i < data.length; i++){
        if(data[i].pk_promotion == value){
          rabais = data[i].rabais * 100;
          rabaisTxt = rabais + " %";
          document.getElementById("rabais").value = rabaisTxt;
        }
      }

    }
  };
}
