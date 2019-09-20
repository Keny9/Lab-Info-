<?php
  require_once('classService.php');

class Facture{

  private $id;
  private $nomClient;
  private $prenomClient;
  private $dateService;
  private $paiementStatus;
  private $noConfirmation;

  /**
  * Constructeur d'une facture
  */
  function __construct($id,$prenomClient,$nomClient,$dateService,$paiementStatus,$noConfirmation){
    $this->setId($id);
    $this->setPrenomClient($prenomClient);
    $this->setNomClient($nomClient);
    $this->setDateService($dateService);
    $this->setPaiementStatus($paiementStatus);
    $this->setNoConfirmation($noConfirmation);
  }

  public function setId($id){
    $this->id = $id;
  }

  public function setNomClient($nomClient){
    $this->nomClient = $nomClient;
  }

  public function setDateService($dateService){
    $date = substr($dateService,0, -9);
    $this->dateService = $date;
  }

  public function setPaiementStatus($paiementStatus){
    $this->paiementStatus = $paiementStatus;
  }

  public function setNoConfirmation($noConfirmation){
    $this->noConfirmation = $noConfirmation;
  }

  public function setPrenomClient($prenomClient){
    $this->prenomClient = $prenomClient;
  }

  public function getId(){
    return $this->id;
  }

  public function getPrenomClient(){
    return $this->prenomClient;
  }

  public function getNomClient(){
    return $this->nomClient;
  }

  public function getDateService(){
    return $this->dateService;
  }

  public function getPaiementStatus(){
    return $this->paiementStatus;
  }

  public function getNoConfirmation(){
    return $this->noConfirmation;
  }

}


?>
