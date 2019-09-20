<?php
$conn = mysqli_connect("localhost", "root", "","lab1_hypermedia");
if ($conn->connect_error) {
  echo "error";
  $conn->close();
  echo "error";
}
else{
  $email = "a";//$_POST['email'];
  $password = "a";//$_POST['password'];
  $sql = "SELECT courriel, mot_de_passe FROM utilisateur WHERE courriel = '".$email."' AND mot_de_passe = '".$password."'";
  $result = $conn->query($sql);

  echo "hehe";

  if (!$result){
    echo "error";
  }
  else{
    echo "success";
  }

  print_r($result);


  $conn->close();
}
?>
