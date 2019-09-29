<?php
require_once('../outils/connexion.php');
require_once('classService.php');

class GestionService{

  /**
  * Fonction permettant d'obtenir tous les services peuplant la base de donnee
  */
  public function getAllService(){
    $connection = new Connexion();
    $conn = $connection->getConnexion();

    $query = "SELECT * FROM service ORDER BY service_titre;";
    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) == 0){
      $service = null;
    }
    else{
      while($row = mysqli_fetch_assoc($result)){
        $service[] = new Service($row['pk_service'],$row['service_titre'],$row['service_description'],$row['duree'],$row['tarif'],$row['actif'],$row['image']);
      }
    }

    return $service;
  }

  //Obtenir un service en particulier
  public function getService($idService){
    $connexion = new Connexion();
    $conn = $connexion->getConnexion();

    $stmt = $conn->prepare("SELECT * FROM service WHERE pk_service = ?;");
    $stmt->bind_param("i",$id);

    $id = $idService;
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) exit('Pas de ligne');

    $row = $result->fetch_assoc();
    $service = new Service($row['pk_service'],$row['service_titre'],$row['service_description'],$row['duree'],$row['tarif'],$row['actif'],$row['image']);

    $stmt->close();

    return $service;
  }

  //Fonction qui permet de faire une recherche par un mot
  public function getServiceBySearch($word){
    $connexion = new Connexion();
    $conn = $connexion->getConnexion();

    $stmt = $conn->prepare("SELECT * FROM service
                            WHERE service_titre LIKE '%$word%' OR service_description LIKE '%$word%';");

    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 0) $service = null;

    while($row = mysqli_fetch_assoc($result)){
      $service[] = new Service($row['pk_service'],$row['service_titre'],$row['service_description'],$row['duree'],$row['tarif'],$row['actif'],$row['image']);
    }

    $stmt->close();
    return $service;
  }

  /**
  * Fonction qui permet d'obtenir le dernier id d'un service
  */
  public function getLastId(){
    $connexion = new Connexion();
    $conn = $connexion->getConnexion();

    $stmt = $conn->prepare("SELECT MAX(pk_service) FROM service;");
    $stmt->execute();

    $result = $stmt->get_result();

    if(!$result){
      die('Could not query:' . mysqli_error());
    }

    $row = $result->fetch_assoc();
    $lastId = $row['MAX(pk_service)'] + 1;

    $stmt->close();
    return $lastId;
  }

  //Fonction qui permet de mettre à jour un service
  public function updateService($service){
    $connexion = new Connexion();
    $conn = $connexion->getConnexion();

    $stmt = $conn->prepare("UPDATE service
                            SET service_titre = ?, service_description = ?, duree = ?, tarif = ?, actif = ?, image = ?
                            WHERE pk_service = ?;");
    $stmt->bind_param("ssidisi", $titre, $description, $duree, $tarif, $actif, $image, $id);

    //set parameters
    $titre = $service->getTitre();
    $description = $service->getDescription();
    $duree = $service->getDuree();
    $tarif = $service->getTarif();
    $actif = $service->getActif();
    $image = $service->getImage();
    $id = $service->getId();

    $status = $stmt->execute();
    /* check whether the execute() succeeded */
    if ($status === false) {
      trigger_error($stmt->error, E_USER_ERROR);
    }

    $stmt->close();
  }

  /**
  * @param service Un nouveau service a ajouter a la base de donnee
  */
  public function addService($service){
    $connexion = new Connexion();
    $conn = $connexion->getConnexion();

    $stmt = $conn->prepare("INSERT INTO service (pk_service, service_titre, service_description, duree, tarif, actif, image) VALUES
                          (?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("issidis", $id, $titre, $description, $duree, $tarif, $actif, $image);

    //set parameters
    $id = $this->getLastId();
    $titre = $service->getTitre();
    $description = $service->getDescription();
    $duree = $service->getDuree();
    $tarif = $service->getTarif();
    $actif = $service->getActif();
    $image = $service->getImage();

    $stmt->execute();
    $stmt->close();

  }

}

?>
