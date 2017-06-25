<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Report Lost Item</title>
  <h2>Report Lost Item</h2>
  <?php require 'modules/header.php'; ?>
</head>

<?php
//redirects to login page if user is not logged in
require 'modules/validateUser.php';
require 'modules/uploadImage.php';

$username = $_COOKIE["username"];

$item_name = $_POST["item-name"];
$description = $_POST["description"];
$date_found = $_POST["date-found"];
$category = $_POST["category"];
$place_found = $_POST["place-found"];
$colour = $_POST["colour"];

$image_path = uploadImage($username);

require 'modules/databaseConnection.php';
$stmt = "INSERT INTO lost_items(item_name, description, date_found, category, user, place_found, colour, image_path) VALUES ('$item_name','$description','$date_found','$category','$username','$place_found','$colour','$image_path')";
$conn->exec($stmt);

?>
</html>
