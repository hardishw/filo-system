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

$username = $_COOKIE["username"];

$item_name = $_POST["item-name"];
$description = $_POST["description"];
$date_found = $_POST["date-found"];
$category = $_POST["category"];
$place_found = $_POST["place-found"];
$colour = $_POST["colour"];

$target_dir = "../images/" . $username . "/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
    echo "<p>your file was not uploaded.</p>";
// if everything is ok, try to upload file

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

require 'modules/databaseConnection.php';
$stmt = "INSERT INTO lost_items(item_name, description, date_found, category, user, place_found, colour, image_path) VALUES ('$item_name','$description','$date_found','$category','$username','$place_found','$colour','$target_file')";
$conn->exec($stmt);

?>
</html>
