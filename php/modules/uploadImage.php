<?php
function uploadImage($username){
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
          echo "Successfully reported found lost item!";
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }

  return $target_file;
}
?>
