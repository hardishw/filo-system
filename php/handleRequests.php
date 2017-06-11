<?php
  $request = $_POST["request"];
  $item_name = $_POST["item_name"];
  $username = $_POST["username"];


  $conn = new PDO("mysql:host=localhost;dbname=wilkhuh_db", "wilkhuh","rent59deny");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if($request === "approve"){
    $stmt = "UPDATE requests SET status = 'APPROVED', date_resolved = cast(now() as date) WHERE item_name = '$item_name' AND username = '$username'";
    $conn->exec($stmt);
  }elseif ($request === "reject") {
    $stmt = "UPDATE requests SET status = 'REJECTED', date_resolved = cast(now() as date)  WHERE item_name = '$item_name' AND username = '$username'";
    $conn->exec($stmt);
  }

?>
