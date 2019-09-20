<?php

class Service{

  private $id;
  private $titre;
  private $description;
  private $duree;
  private $tarif;
  private $actif;
  private $image;

  /**
  * Constructeur d'un service
  */
  function __construct($id,$titre,$description,$duree,$tarif,$actif,$image){
    $this->setId($id);
    $this->setTitre($titre);
    $this->setDescription($description);
    $this->setDuree($duree);
    $this->setTarif($tarif);
    $this->setActif($actif);
    $this->setImage($image);
  }

  public function setId($id){
    $this->id = $id;
  }

  public function setTitre($titre){
    $this->titre = $titre;
  }

  public function setDescription($description){
    $this->description = $description;
  }

  public function setDuree($duree){
    $this->duree = $duree;
  }

  public function setTarif($tarif){
    $this->tarif = $tarif;
  }

  public function setActif($actif){
    $this->actif = $actif;
  }

  public function setImage($image){
    $this->image = $image;
  }

  public function getId(){
    return $this->id;
  }

  public function getTitre(){
    return $this->titre;
  }

  public function getDescription(){
    return $this->description;
  }

  public function getDuree(){
    return $this->duree;
  }

  public function getTarif(){
    return $this->tarif;
  }

  public function getActif(){
    return $this->actif;
  }

  public function getImage(){
    return $this->image;
  }
}

?>
