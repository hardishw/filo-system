<?php

  $request = $_POST["request"];
  $id = $_POST["request_id"];
  $username = $_COOKIE["username"];
  $message = "";

  require 'modules/databaseConnection.php';

  if($request === "approve"){
    $stmt = "UPDATE requests SET status = 'APPROVED', date_resolved = cast(now() as date) WHERE id = $id";
    $conn->exec($stmt);

    $message = "Congratulations! Your request has been approved.";

  }elseif ($request === "reject") {
    $stmt = "UPDATE requests SET status = 'REJECTED', date_resolved = cast(now() as date)  WHERE id = $id";
    $conn->exec($stmt);

    $message = "Unfortunately the admin feels that you do not have a claim to the item in the request so it has been rejected.";

  }

  $stmt = $conn->prepare("SELECT email FROM users WHERE username = '$username'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $result = $stmt->fetchAll();
  $email = $result[0]["email"];
  $request = strtoupper(rtrim($request,'e'));
  mail("{$email}", "Request {$id} - {$request}ED","{$message}");

?>
