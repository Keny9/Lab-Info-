<?php

  require_once('./class/promotion.php');
  require_once('./class/gestionPromotion.php');

  //Convert to UTF-8
  //Sinon du vide etait afficher
  function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

  $gestionPromotion = new GestionPromotion();

  $data = $gestionPromotion->getAllPromoData();

  echo json_encode(utf8ize($data));

?>
