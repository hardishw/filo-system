<?php

function validateAdmin()
{
  $isValidUser = 0;
  $password =$_COOKIE["password"];
  $username =$_COOKIE["username"];

  require 'databaseConnection.php';
  $stmt = $conn->prepare("SELECT password,is_admin FROM users WHERE username = '$username'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $result = $stmt->fetchAll();

  if (strcmp($password,$result[0]["password"]) == 0 && !empty($password)){
    if ($result[0]["is_admin"] == 1){
      $isValidUser = 1;
    }
  }

  return $isValidUser;
}

if(validateAdmin() == 0){
  header('Location: /index.php');
}

?>
