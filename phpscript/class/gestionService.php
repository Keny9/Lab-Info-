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



}

?>
