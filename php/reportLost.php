<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Report Lost Item</title>
  <h2>Report Lost Item</h2>
  <?php require 'modules/header.php'; ?>
</head>

<body>
  <form action="../php/addLostItem.php" method="post" enctype="multipart/form-data">
    <p style="color:red;">* required </p>
    <p>
      Item Name <span style="color:red;">*</span>:
      <input type="text" name="item-name" size="15" maxlength="20" required>
    </p>
    <p>
      Description:
      <br>
      <textarea name="description" cols="40" rows="5" maxlength="255"></textarea>
    </p>
    <p>
      Date Found <span style="color:red;">*</span>:
      <input type="date" name="date-found" required>
    </p>
    <p>
      Category <span style="color:red;">*</span>:
      <input type="radio" name="category" value="Pets" required> Pets
      <input type="radio" name="category" value="Electronics"> Electronics
      <input type="radio" name="category" value="Jewellery"> Jewellery
    </p>
    <p>
      Place Found <span style="color:red;">*</span>:
      <input type="text" name="place-found" size="15" height="10" maxlength="100" required>
    </p>
    <p>
      Colour:
      <input type="text" name="colour" size="15" maxlength="20">
    </p>
    <p>
      Upload Picture <span style="color:red;">*</span>:<input type="file" name="fileToUpload" id="fileToUpload" required>
    </p>
    <p>
      <input type="submit" name="submit" value="Submit">
    </p>

  </form>
</body>

</html>
