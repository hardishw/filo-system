<?php

function validateUser()
{
  $isValidUser = 0;
  $password =$_COOKIE["password"];
  $username =$_COOKIE["username"];

  require 'databaseConnection.php';
  $stmt = $conn->prepare("SELECT password FROM users WHERE username = '$username'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $result = $stmt->fetchAll();

  if (strcmp($password,$result[0]["password"]) == 0 && !empty($password)){
    $isValidUser = 1;
  }

  return $isValidUser;
}

if(validateUser() == 0){
  header('Location: ../login-page.php');
}

?>
