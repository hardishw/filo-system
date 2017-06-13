<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Search Results</title>
  <h2>Search Results</h2>
  <a href="../index.html">Home</a>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>

    <?php
    $search = strtolower($_POST["search"]);
    $date_min = $_POST["date_min"];
    $date_max = $_POST["date_max"];
    $category = $_POST["category"];

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


    require 'modules/databaseConnection.php';
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<br>";
    echo "<br>";


    echo "<table>";
    echo "<tr>";
    echo "<th>Item name</th>";
    echo "<th>Category</th>";
    echo "<th>Place found</th>";
    echo "<th>Date found</th>";
    echo "<th>More details</th>";
    echo "</tr>";
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
  <a href="../index.html">Home</a>
</footer>

</html>
