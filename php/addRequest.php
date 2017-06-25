<?php
$item_id = $_POST["item_id"];
$reason = $_POST["request_reason"];
$username = $_COOKIE["username"];

require 'modules/databaseConnection.php';
$stmt = $conn->prepare("SELECT item_name FROM lost_items where id = $item_id");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll()[0]["item_name"];

$stmt = $conn->prepare("SELECT id FROM users where username = '$username'");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$user_id = $stmt->fetchAll()[0]["id"];

$stmt = "INSERT INTO requests(item_name, item_id, username, status,date_submitted,reason,user_id) VALUES ('$result',$item_id,'$username','PENDING',cast(now() as date),'$reason',$user_id)";
$conn->exec($stmt);

?>
