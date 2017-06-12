<?php
$item_id = $_POST["item-id"];
require 'databaseConnection.php';
$stmt = $conn->prepare("SELECT * FROM lost_items WHERE id = '$item_id'");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
echo "<br>";
echo "<br>";

echo "<table>";
echo "<tr>";
echo "<th>Item name</th>";
echo "<th>Description</th>";
echo "<th>Date Found</th>";
echo "<th>User</th>";
echo "<th>Place Found</th>";
echo "<th>Colour</th>";
echo "<th>Image</th>";
echo "</tr>";

foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
    echo "<tr>";
    echo"<td>" . $v["item_name"] . "</td><td>" . $v["description"] . "</td><td>" . $v["category"] . "</td><td>" . $v["user"] . "</td><td>" .  $v["place_found"] . "</td><td>" .
      $v["colour"] . "</td><td><img src='". $v['image_path'] . "' alt='item image' width=\"100\" height=\"100\"></td>";
    echo "</tr>";
}
echo "</table>";
?>
