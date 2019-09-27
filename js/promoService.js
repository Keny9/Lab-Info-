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
