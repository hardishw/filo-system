<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Register</title>
  <a href="../index.html">Home</a>
</head>

<body>
<?php
$error = $_GET["error"];
switch ($error) {
  case 'value':
    # code...
    break;

  default:
    # code...
    break;
}
?>

  <form action="../php/registerUser.php" method="post">
    <p style="color:red;">* required </p>
    <p>
      Username:
      <input type="text" name="username" size="15" maxlength="20"> *
    </p>
    <p>
      Firstname:
      <input type="text" name="firstname" size="15" maxlength="20">
    </p>
    <p>
      Surname:
      <input type="text" name="secondname" size="15" maxlength="20">
    </p>
    <p>
      Password:
      <input type="password" name="password" size="15" maxlength="20"> *
    </p>
    <p>
      Repeat Password:
      <input type="password" name="repeat-password" size="15" maxlength="20"> *
    </p>
    <p>
      Email:
      <input type="text" name="email" size="15" maxlength="50"> *
    </p>
    <p>
      Repeat Email:
      <input type="text" name="repeat-email" size="15" maxlength="50"> *
    </p>
    <p>
      <input type="submit" name="submit" value="Submit">
    </p>

  </form>
</body>

</html>
