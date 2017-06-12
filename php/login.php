<html>

<head>
  <title>FiLo System - Login</title>
  <a href="../index.html">Home</a>
</head>

<body>

    <?php
    $username = $_POST["username"];
    $password = $_POST["password"];

    require 'databaseConnection.php';
    $stmt = $conn->prepare("SELECT firstname,secondname,password FROM users WHERE username = '$username'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

	  $result = $stmt->fetchAll();

    if (password_verify($password,$result[0]["password"])){
      setcookie("password",$result[0]["password"], time() + 3600,"/");
      setcookie("username",$username, time() + 3600,"/");
      echo "<p>Successfully Logged In</p>";
    }else {
      header('Location: ../php/login-page.php?error=true');
    }

    ?>



</body>

</html>
