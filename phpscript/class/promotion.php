<?php
  require_once('../outils/connexion.php');
  /**
  * Une promotion peut apparaitre plusieurs fois avec le meme titre puisqu'il peut être appliquer plusieurs fois a différent services
  * Cette classe ne représente pas seulement une promotion existante dans la bd, mais plutôt les promotions qui ont été appliqués sur un service.
  */
  class Promotion{

    private $id;
    private $titre;
    private $description;
    private $rabais;
    private $image;
    private $dateDebut; //Si promo appliquer sur un service pour qu'il y ait une date
    private $dateFin;
    private $code; //Si promo est appliqué sur un service
    private $service; //Service auquel la promotion est associé s'il y a lieu

    /**
    * Constructeur d'une promotion
    */
    function __construct($id,$titre,$description,$rabais,$image,$dateDebut,$dateFin,$code){
      $this->setId($id);
      $this->setTitre($titre);
      $this->setDescription($description);
      $this->setRabais($rabais);
      $this->setImage($image);
      $this->setDateDebut($dateDebut);
      $this->setDateFin($dateFin);
      $this->setCode($code);
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
      $this->dateFin = $dateFin;
    }

    public function setDateDebut($dateDebut){
      $this->dateDebut = $dateDebut;
    }

    public function setImage($image){
      $this->image = $image;
    }

    public function setRabais($rabais){
      $this->rabais = $rabais;
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
  }
 ?>
