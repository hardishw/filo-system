<?php
$username = $_COOKIE["filo-login"];
//redirects to login page if user is not logged in
if(empty($username)){
  header('Location: ../html/login.html');
}
$item_name = $_POST["item-name"];
$description = $_POST["description"];
$date_found = $_POST["date-found"];
$category = $_POST["category"];
$place_found = $_POST["place-found"];
$colour = $_POST["colour"];

$target_dir = "../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$file_name = $_FILES["fileToUpload"]["name"];
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    echo "your file was not uploaded.";
// if everything is ok, try to upload file

} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn = new PDO("mysql:host=localhost;dbname=wilkhuh_db", "wilkhuh","rent59deny");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = "INSERT INTO lost_items(item_name, description, date_found, category, user, place_found, colour, image_path) VALUES ('$item_name','$description','$date_found','$category','$username','$place_found','$colour','$file_name '";
$conn->exec($stmt);

?>
