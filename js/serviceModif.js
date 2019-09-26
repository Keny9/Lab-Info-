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
