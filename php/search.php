<html>

<head>
  <title>FiLo System - Search Results</title>
  <a href="../index.html">Home</a>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>
  <form action="moreDetails.php" method="post">
    <?php
    $search = $_POST["search"];
    $date_min = $_POST["date_min"];
    $date_max = $_POST["date_max"];
    $category = $_POST["category"];

    require 'databaseConnection.php';
    $stmt = $conn->prepare("SELECT id,item_name,category,place_found,date_found FROM lost_items WHERE (date_found BETWEEN '$date_min' AND '$date_max') AND category = '$category' AND item_name LIKE '%$search%'");
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
        echo "<tr>";
        echo "<td>" . $v["item_name"] . "</td><td>" . $v["category"] . "</td><td>" . $v["place_found"] . "</td><td>" . $v["date_found"] . "</td><td><input type=\"submit\" name=\"submit\" value=\"More Details\"></td>";
        echo '<input name="item-id" type="hidden" value="' . $v["id"] . '">';
        echo "</tr>";
    }
    echo "</table>";
    ?>
</form>

</body>

<footer>
  <a href="../index.html">Home</a>
</footer>

</html>
