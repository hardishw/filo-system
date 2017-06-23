<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Report Lost Item</title>
  <h2>Report Lost Item</h2>
  <a href="../index.html">Home</a>
</head>

<body>
  <?php
  require 'modules/validateUser.php';

  $error = $_GET["error"];
  switch ($error) {
    case '1':
      echo '<p style="color:red;">Item Name cannot be empty</p>';
      break;
    case '2':
      echo '<p style="color:red;">Date Found cannot be empty</p>';
      break;
    case '3':
      echo '<p style="color:red;">You must choose a category</p>';
      break;
    case '4':
      echo '<p style="color:red;">Place Found cannot be empty</p>';
      break;
    case '5':
      echo '<p style="color:red;">An image must be uploaded</p>';
      break;
  }
  ?>
  <form action="../php/addLostItem.php" method="post" enctype="multipart/form-data">
    <p style="color:red;">* required </p>
    <p>
      Item Name <span style="color:red;">*</span>:
      <input type="text" name="item-name" size="15" maxlength="20">
    </p>
    <p>
      Description:
      <br>
      <textarea name="description" cols="40" rows="5" maxlength="255"></textarea>
    </p>
    <p>
      Date Found <span style="color:red;">*</span>:
      <input type="date" name="date-found" size="15" maxlength="20">
    </p>
    <p>
      Category <span style="color:red;">*</span>:
      <input type="radio" name="category" value="Pets"> Pets
      <input type="radio" name="category" value="Electronics"> Electronics
      <input type="radio" name="category" value="Jewellery"> Jewellery
    </p>
    <p>
      Place Found <span style="color:red;">*</span>:
      <input type="text" name="place-found" size="15" height="10" maxlength="100">
    </p>
    <p>
      Colour:
      <input type="text" name="colour" size="15" maxlength="20">
    </p>
    <p>
      Upload Picture<span style="color:red;">*</span>:<input type="file" name="fileToUpload" id="fileToUpload">
    </p>
    <p>
      <input type="submit" name="submit" value="Submit">
    </p>

  </form>
</body>

</html>
