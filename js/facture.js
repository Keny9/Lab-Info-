function afficheDetail(i){
  document.getElementById("block-detail-" + i).style.display = "inline-block";
  document.getElementById("link-detail-" + i).style.display = "none";
}

function cacheDetail(i){
  document.getElementById("block-detail-" + i).style.display = "none";
  document.getElementById("link-detail-" + i).style.display = "inline-block";
}
