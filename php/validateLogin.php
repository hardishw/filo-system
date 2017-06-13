<?php
    $username = $_POST["username"];
    $password = $_POST["password"];

    require 'modules/databaseConnection.php';
    $stmt = $conn->prepare("SELECT firstname,secondname,password FROM users WHERE username = '$username'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

	  $result = $stmt->fetchAll();

    if (password_verify($password,$result[0]["password"])){
      setcookie("password",$result[0]["password"], time() + 3600,"/");
      setcookie("username",$username, time() + 3600,"/");
      header('Location: /index.html');
    }else {
      header('Location: ../php/login-page.php?error=true');
    }
?>
