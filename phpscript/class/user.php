<?php
class User{
  private $pk;
  private $courriel;
  private $mot_de_passe;
  private $administrateur;

  function __construct($pk, $courriel, $mot_de_passe, $administrateur){
    $this->setPk($pk);
    $this->setCourriel($courriel);
    $this->setMotDePasse($mot_de_passe);
    $this->setAdministrateur($administrateur);
  }

  public function setPk($pk){
    $this->pk = $pk;
  }
  public function setCourriel($courriel){
    $this->courriel = $courriel;
  }
  public function setMotDePasse($mot_de_passe){
    $this->mot_de_passe = $mot_de_passe;
  }
  public function setAdministrateur($administrateur){
    $this->administrateur = $administrateur;
  }
  public function getPk(){
    return $this->pk;
  }
  public function getCourriel(){
    return $this->courriel;
  }
  public function getMotDePasse(){
    return $this->mot_de_passe;
  }
  public function getAdministrateur(){
    return $this->administrateur;
  }
}
?>
