<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Search Results</title>
  <h2>Search Results</h2>
  <?php require 'modules/header.php'; ?>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>

    <?php
    $search = strtolower($_POST["search"]);
    $date_min = $_POST["date_min"];
    $date_max = $_POST["date_max"];
    $category = $_POST["category"];
    $order_by = $_POST["order_by"];
    $order_direction = $_POST["order_direction"];

    $query = "SELECT id,item_name,category,place_found,date_found FROM lost_items WHERE lower(item_name) LIKE '%$search%'";

    if(!empty($date_min)){
      $query = $query . " AND date_found >= '$date_min'";
    }
    if(!empty($date_max)){
      $query = $query . " AND date_found <= '$date_max'";
    }
    if (!empty($category)) {
      $query = $query . " AND category = '$category'";
    }
    if (!empty($order_by)) {
      $query = $query . " ORDER BY $order_by $order_direction";
    }


    require 'modules/databaseConnection.php';
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<br>";
    echo "<br>";

    echo"<form action='search.php' method='post'>
    Order By:  <select name='order_by'>
    <option value='item_name'>Item Name</option>
    <option value='category'>Category</option>
    <option value='place_found'>Place Found</option>
    <option value='date_found'>Date Found</option>
    </select>  <select name='order_direction'>
    <option value='ASC'>Ascending</option>
    <option value='DESC'>Descending</option>
    </select>  <input type='submit'>
    <br>
    <br>
    <input name='date_min' type='hidden' value='{$date_min}'>
    <input name='search' type='hidden' value='{$search}'>
    <input name='date_max' type='hidden' value='{$date_max}'>
    <input name='category' type='hidden' value='{$category}'>
    </form>";
    echo "<table>
    <tr>
    <th>Item Name</th><th>Category</th><th>Place Found</th><th>Date found</th><th>More details</th>
    </tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
      echo '<form action="moreDetails.php" method="post">';
        echo "<tr>";
        echo "<td>" . $v["item_name"] . "</td><td>" . $v["category"] . "</td><td>" . $v["place_found"] . "</td><td>" . $v["date_found"] . "</td><td><input type=\"submit\" name=\"submit\" value=\"More Details\"></td>";
        echo '<input name="item-id" type="hidden" value="' . $v["id"] . '">';
        echo "</tr>";
        echo '</form>';
    }
    echo "</table>";
    ?>


</body>

<footer>
  <br>
  <br>
  <a href="../index.php">Home</a>
</footer>

</html>
