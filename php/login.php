<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Login</title>
  <a href="../index.html">Home</a>
</head>

<body>
  <?php
    $error = $_GET["error"];
    if($error){
      echo "<p style'color:red;'>Incorrect Login Details</p>";
    }
  ?>
  <form action="/php/validateLogin.php" method="post">

    <p>
      Username:
      <input type="text" name="username" size="15" maxlength="20">
    </p>
    <p>
      Password:
      <input type="password" name="password" size="15" maxlength="20">
    </p>
    <p>
      Not registered? <a href="/php/register.php">Click here</a>
    </p>
    <p>
      <input type="submit" name="submit" value="Submit">
    </p>

  </form>

</body>

</html>
