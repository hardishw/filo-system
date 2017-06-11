<html>

<head>
  <title>FiLo System - Login</title>
  <a href="../index.html">Home</a>
</head>

<body>

    <?php
    $username = $_POST["username"];
    $password = $_POST["password"];

    $conn = new PDO("mysql:host=localhost;dbname=wilkhuh_db", "wilkhuh","rent59deny");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT firstname,secondname,password FROM users WHERE username = '$username'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

	  $result = $stmt->fetchAll();

    if (password_verify($password,$result[0]["password"])){
      setcookie("filo-login", $username, time() + 3600,"/");
      echo "<p>Successfully Logged In</p>";
    }else {
      echo "<p>Unsuccessfull Attempt</p>";
    }

    ?>



</body>

</html>
