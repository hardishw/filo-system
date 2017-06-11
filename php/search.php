<html>

<head>
  <title>FiLo System - Search Results</title>
  <a href="../index.html">Home</a>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
</head>

<body>
    <?php
    $search = $_POST["search"];
    $date_min = $_POST["date_min"];
    $date_max = $_POST["date_max"];
    $category = $_POST["category"];

    $conn = new PDO("mysql:host=localhost;dbname=wilkhuh_db", "wilkhuh","rent59deny");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT item_name,category,place_found,date_found FROM lost_items WHERE (date_found BETWEEN '$date_min' AND '$date_max') AND category = '$category' AND item_name LIKE '%$search%'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    echo "<br>";
    echo "<br>";

    echo "<table>";
    echo "<tr>";
    echo "<th>item_name</th>";
    echo "<th>category</th>";
    echo "<th>place_found</th>";
    echo "<th>date_found</th>";
    echo "</tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo "<tr>";
        echo "<td>" . $v["item_name"] . "</td><td>" . $v["category"] . "</td><td>" . $v["place_found"] . "</td><td>" . $v["date_found"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>



</body>

<footer>
  <a href="../index.html">Home</a>
</footer>

</html>
