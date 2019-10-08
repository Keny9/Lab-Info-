<?php
class Profile{
  private $pk;
  private $fk_user;
  private $prenom;
  private $nom;
  private $telephone;
  private $noCivique;
  private $rue;
  private $ville;
  private $codePostal;
  private $infoLettre;

  function __construct($pk, $fk_user, $prenom, $nom, $telephone, $noCivique, $rue, $ville, $codePostal, $infoLettre){
    $this->setPk($pk);
    $this->setFkUser($fk_user);
    $this->setPrenom($prenom);
    $this->setNom($nom);
    $this->setTelephone($telephone);
    $this->setNoCivique($noCivique);
    $this->setRue($rue);
    $this->setVille($ville);
    $this->setCodePostal($codePostal);
    $this->infoLettre($infoLettre);
  }

  public function setPk($pk){
    $this->pk = $pk;
  }
  public function setFkUser($fk_user){
    $this->fk_user = $fk_user;
  }
  public function setPrenom($prenom){
    $this->prenom = $prenom;
  }
  public function setNom($nom){
    $this->nom = $nom;
  }

  public function setTelephone($telephone){
    $this->telephone = $telephone;
  }

  public function setNoCivique($noCivique){
    $this->noCivique = $noCivique;
  }

  public function setRue($rue){
    $this->rue = $rue;
  }

  public function setVille($ville){
    $this->ville = $ville;
  }

  public function setCodePostal($codePostal){
    $this->ville = $ville;
  }

  public function setInfoLettre($infoLettre){
    $this->ville = $ville;
  }

  public function getPk(){
    return $this->pk;
  }

  public function getFkUser(){
    return $this->fk_user;
  }

  public function getPrenom(){
    return $this->prenom;
  }

  public function getNom(){
    return $this->nom;
  }

  public function getTelephone(){
    return $this->telephone;
  }

  public function getNoCivique(){
    return $this->noCivique;
  }

  public function getRue(){
    return $this->rue;
  }

  public function getVille(){
    return $this->ville;
  }

  public function getCodePostal(){
    return $this->codePostal;
  }

  public function getInfoLettre(){
    return $this->infoLettre;
  }
}
?>
