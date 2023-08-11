
<?php
  require_once('db.php');
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['signIn'])){
      $email = $_POST['email'];
      $pass = $_POST['password'];
  
      // Assuming $conn is your database connection
      $stmt = $conn->prepare("SELECT id, password FROM registrationn WHERE email = ?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $stmt->bind_result($id, $storedPassword);
  
      $response = array();
  
      if($stmt->fetch()){
          if($storedPassword === $pass){
              session_start();
              $_SESSION['token'] = $id;
              $response = array("response" => "success");
          }
          else{
              $response = array("response" => "pass");
          }
      }
      else{
          $response = array("response" => "email");
      }
  
      $stmt->close();
      $jsondata = json_encode($response);
      header("Content-type: application/json");
      echo $jsondata;
  }
}
     ?>
