<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Register</title>
  <h2>Register</h2>
  <?php require 'modules/header.php'; ?>
  <style>
    .error {
      color:red;
      font-size: 150%;
    }
  </style>
</head>

<body>
<?php
$error = $_GET["error"];
switch ($error) {
  case '1':
    echo '<p class="error">passwords don\'t match</p>';
    break;
  case '2':
    echo '<p class="error">emails don\'t match</p>';
    break;
  case '3':
    echo '<p class="error">username already exists</p>';
    break;
}
?>

  <form action="/php/addUser.php" method="post">
    <p style="color:red;">* required </p>
    <p>
      Username:
      <input type="text" name="username" size="15" maxlength="20" required> <span style="color:red;">*</span>
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
      <input type="password" name="password" size="15" maxlength="20" required> <span style="color:red;">*</span>
    </p>
    <p>
      Repeat Password:
      <input type="password" name="repeat-password" size="15" maxlength="20" required> <span style="color:red;">*</span>
    </p>
    <p>
      Email:
      <input type="text" name="email" size="15" maxlength="50" required> <span style="color:red;">*</span>
    </p>
    <p>
      Repeat Email:
      <input type="text" name="repeat-email" size="15" maxlength="50" required> <span style="color:red;">*</span>
    </p>
    <p>
      <input type="submit" name="submit" value="Submit">
    </p>

  </form>
</body>

</html>
