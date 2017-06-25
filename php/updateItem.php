<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Edit Item</title>
  <h2>Edit Item</h2>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <?php require 'modules/header.php'; ?>
</head>

<body>
  <?php
  require 'modules/uploadImage.php';
  require 'modules/databaseConnection.php';

  $item_id = $_POST["id"];
  $item_name = $_POST["item-name"];
  $description = $_POST["description"];
  $date_found = $_POST["date-found"];
  $category = $_POST["category"];
  $place_found = $_POST["place-found"];
  $colour = $_POST["colour"];
  $user = $_POST["user"];

  $query = "UPDATE lost_items SET";

  if(!empty($item_name)){
    $query = $query . " item_name='$item_name',";
  }
  if(!empty($description)){
    $query = $query . " description='$description',";
  }
  if(!empty($date_found)){
    $query = $query . " date_found='$date_found',";
  }
  if(!empty($category)){
    $query = $query . " category='$category',";
  }
  if(!empty($place_found)){
    $query = $query . " place_found='$place_found',";
  }
  if(!empty($colour)){
    $query = $query . " colour='$colour',";
  }
  if(!empty($user)){
    $query = $query . " user='$user',";
  }
  if (!empty($_FILES["fileToUpload"]["name"])) {
    $image_path = uploadImage($_COOKIE["username"]);
    $query = $query . " image_path='$image_path'";
  }

  $query = rtrim($query,',');

  $query = $query . " WHERE id = $item_id";

  $conn->exec($query);

   ?>

<p>Item has been successfully updated!</p>

</body>

</html>
