<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Register</title>
  <h2>Register</h2>
  <a href="../index.html">Home</a>
</head>

<body>
<?php
$error = $_GET["error"];
switch ($error) {
  case '1':
    echo '<p style="color:red;"> password cannot be empty or passwords don\'t match</p>';
    break;
  case '2':
    echo '<p style="color:red;"> email cannot be empty or emails don\'t match</p>';
    break;
  case '3':
    echo '<p style="color:red;"> username cannot be empty</p>';
    break;
}
?>

  <form action="/php/addUser.php" method="post">
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
