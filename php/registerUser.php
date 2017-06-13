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
      echo '<form action="registerUser.php" method="post">
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
          <input type="password" name="password" size="15" maxlength="20"><span style="color:red;"> * cannot be empty or passwords don\'t match</span>
        </p>
        <p>
          Repeat Password:
          <input type="password" name="repeat-password" size="15" maxlength="20"><span style="color:red;"> * cannot be empty or passwords don\'t match</span>
        </p>
        <p>
          Email:
          <input type="text" name="email" size="15" maxlength="20"> *
        </p>
        <p>
          Repeat Email:
          <input type="text" name="repeat-email" size="15" maxlength="20"> *
        </p>
        <p>
          <input type="submit" name="submit" value="Submit">
        </p>

      </form>';
    }elseif ((empty($email) or empty($repeat_email)) or ($email != $repeat_email)) {
      echo '<form action="registerUser.php" method="post">
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
          <input type="text" name="email" size="15" maxlength="20"><span style="color:red;"> * cannot be empty or emails don\'t match</span>
        </p>
        <p>
          Repeat Email:
          <input type="text" name="repeat-email" size="15" maxlength="20"><span style="color:red;"> * cannot be empty or emails don\'t match</span>
        </p>
        <p>
          <input type="submit" name="submit" value="Submit">
        </p>

      </form>';
    }elseif (empty($username)) {
      echo '<form action="registerUser.php" method="post">
        <p style="color:red;">* required </p>
        <p>
          Username:
          <input type="text" name="username" size="15" maxlength="20"> <span style="color:red;"> * cannot be empty</span>
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
          <input type="text" name="email" size="15" maxlength="20"> *
        </p>
        <p>
          Repeat Email:
          <input type="text" name="repeat-email" size="15" maxlength="20"> *
        </p>
        <p>
          <input type="submit" name="submit" value="Submit">
        </p>

      </form>';
    }else {
      require 'modules/databaseConnection.php';
      $stmt = "INSERT INTO users (username, firstname, secondname, password, email) VALUES ('$username','$firstname','$secondname','$password','$email')";
      $conn->exec($stmt);

      echo "<p>You Have Successfully Registered!</p>";
    }
    ?>

</body>

</html>
