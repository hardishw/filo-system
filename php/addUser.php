<html>

<head>
  <title>FiLo System - Register</title>
  <a href="../index.html">Home</a>
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

    if((empty($password) or empty($repeat_password)) or (!password_verify($repeat_password,$password))){
      header('Location: /php/register.php?error=1');
    }elseif ((empty($email) or empty($repeat_email)) or ($email != $repeat_email)) {
      header('Location: /php/register.php?error=2');
    }elseif (empty($username)) {
      header('Location: /php/register.php?error=3');
    }else {
      require 'modules/databaseConnection.php';
      $stmt = "INSERT INTO users (username, firstname, secondname, password, email) VALUES ('$username','$firstname','$secondname','$password','$email')";
      $conn->exec($stmt);

      echo "<p>You Have Successfully Registered!</p>";
    }
    ?>

</body>

</html>
