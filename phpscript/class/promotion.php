<?php
  require_once('../outils/connexion.php');
  /**
  * Une promotion peut apparaitre plusieurs fois avec le meme titre puisqu'il peut être appliquer plusieurs fois a différent services
  * Cette classe ne représente pas seulement une promotion existante dans la bd, mais plutôt les promotions qui ont été appliqués sur un service.
  */
  class Promotion{

    private $id;
    private $idPromoService; //id ta_promo_service
    private $titre;
    private $description;
    private $rabais;
    private $image;
    private $dateDebut; //Si promo appliquer sur un service pour qu'il y ait une date
    private $dateFin;
    private $code; //Si promo est appliqué sur un service
    private $service; //Service auquel la promotion est associé s'il y a lieu (ID)
    private $services;
        
    /**
    * Constructeur d'une promotion
    */
    function __construct($id,$idPromoService,$titre,$description,$rabais,$image,$dateDebut,$dateFin,$code,$service){
      $this->setId($id);
      $this->setIdPromoService($idPromoService);
      $this->setTitre($titre);
      $this->setDescription($description);
      $this->setRabais($rabais);
      $this->setImage($image);
      $this->setDateDebut($dateDebut);
      $this->setDateFin($dateFin);
      $this->setCode($code);
      $this->setService($service);
    }

    public function setIdPromoService($idPromoService){
      $this->idPromoService = $idPromoService;
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

    public function setCode($code){
      $this->code = $code;
    }

    public function setDateFin($dateFin){
      if(strlen($dateFin) == 10){ //Si la date est deja transformer on fait rien
        $this->dateFin = $dateFin;
      }
      else{ //sinon on coupe pour enlever les 0 a la fin de la date (format dans lequel ils sont dans la bd)
        $date = substr($dateFin, 0, -9);
        $this->dateFin = $date;
      }
    }

    public function setDateDebut($dateDebut){
      if(strlen($dateDebut) == 10){
        $this->dateDebut = $dateDebut;
      }
      else{
        $date = substr($dateDebut, 0, -9);
        $this->dateDebut = $date;
      }
    }

    public function setImage($image){
      $this->image = $image;
    }

    public function setRabais($rabais){
      $this->rabais = $rabais;
    }

    public function setService($service){
      $this->service = $service;
    }

    public function getId(){
      return $this->id;
    }

    public function getIdPromoService(){
      return $this->idPromoService;
    }

    public function getService(){
      return $this->service;
    }

    public function getTitre(){
      return $this->titre;
    }

    public function getDescription(){
      return $this->description;
    }

    public function getImage(){
      return $this->image;
    }

    public function getCode(){
      return $this->code;
    }

    public function getDateDebut(){
      return $this->dateDebut;
    }

    public function getDateFin(){
      return $this->dateFin;
    }

    public function getRabais(){
      return $this->rabais;
    }
    
    public function setServices($val){
      $this->services = $val;
    }
    public function getServices(){
      return $this->services;
    }
  }
 ?>
