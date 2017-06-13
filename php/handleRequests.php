<?php
  $request = $_POST["request"];
  $item_name = $_POST["item_name"];
  $username = $_POST["username"];


  require 'modules/databaseConnection.php';

  if($request === "approve"){
    $stmt = "UPDATE requests SET status = 'APPROVED', date_resolved = cast(now() as date) WHERE item_name = '$item_name' AND username = '$username'";
    $conn->exec($stmt);
  }elseif ($request === "reject") {
    $stmt = "UPDATE requests SET status = 'REJECTED', date_resolved = cast(now() as date)  WHERE item_name = '$item_name' AND username = '$username'";
    $conn->exec($stmt);
  }

?>
