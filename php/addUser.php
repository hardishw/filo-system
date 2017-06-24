<html>

<head>
  <title>FiLo System - Register</title>
  <h2>Register</h2>
  <?php require 'php/modules/header.php'; ?>
</head>

<body>
    <?php

    $username = $_POST["username"];
    $firstname = $_POST["firstname"];
    $secondname = $_POST["secondname"];
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
    $repeat_password = $_POST["repeat-password"];
    $email = $_POST["email"];
    $repeat_email = $_POST["repeat-email"];

    if(!password_verify($repeat_password,$password)){
      header('Location: /php/register.php?error=1');
    }elseif ($email != $repeat_email) {
      header('Location: /php/register.php?error=2');
    }else {
      require 'modules/databaseConnection.php';
      $stmt = "INSERT INTO users (username, firstname, secondname, password, email) VALUES ('$username','$firstname','$secondname','$password','$email')";
      $conn->exec($stmt);

      echo "<p>You Have Successfully Registered!</p>";
    }
    ?>

</body>

</html>
