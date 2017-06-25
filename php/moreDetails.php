  <!DOCTYPE html>
  <html>

  <head>
    <title>FiLo System - More Details</title>
    <h2>More Details</h2>
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <?php require 'modules/header.php'; ?>
    <a href="/php/search.php"><span>&#8592;</span> Search Results</a>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.request').click(function() {
          var item_id = $(this).parent().data('item-id');
          var reason = document.getElementById("reqdescr").value

          $.post("addRequest.php", {
              item_id: item_id,
              request_reason: reason
            },
            function() {
              location.reload(true);
            });
        });
      });
    </script>
  </head>

  <body>
    <?php
    require 'modules/validateUser.php';
    $item_id = $_POST["item-id"];
    require 'modules/databaseConnection.php';
    $stmt = $conn->prepare("SELECT * FROM lost_items WHERE id = '$item_id'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<table>
          <tr>
          <th>Item name</th>
          <th>Description</th>
          <th>Date Found</th>
          <th>Place Found</th>
          <th>Colour</th>
          <th>Image</th>
          <th>Request Reason</th>
          <th>Request</th>
          <th>Edit Item</th>
          </tr>";

    foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        require 'modules/databaseConnection.php';
        $requested = $conn->prepare("SELECT 1 as requested FROM requests WHERE item_id = $item_id and username = '{$_COOKIE["username"]}'");
        $requested->execute();
        $requested->setFetchMode(PDO::FETCH_ASSOC);
        $result = $requested->fetchAll();

        echo "<tr>";
        echo"<td> {$v["item_name"]} </td><td> {$v["description"]} </td><td> {$v["category"]} </td><td> {$v["place_found"]} </td><td>
          {$v["colour"]} </td><td><img src='{$v['image_path']}' alt='item image' width=\"100\" height=\"100\"></td><td><textarea id=\"reqdescr\" name=\"description\" cols=\"40\" rows=\"5\" maxlength=\"255\"></textarea></td>";
          if ($result[0]["requested"] == 1){
            echo "<td><input type=\"button\" name=\"submit\" value=\"Request\" disabled=\"disabled\">
              <p>Requested</p>
              </td>";
          }else {
            echo "<td><div data-item-id = '$item_id'><input class='request' type=\"button\" name=\"submit\" value=\"Request\"></div></td>";
          }
        echo "<td>
          <form action='editItem.php' method='post'>
          <input type=\"submit\" name=\"edit\" value=\"Edit Item\">
          <input type='hidden' name='item-id' value='$item_id'>
          </form>
          </td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
  </body>

  </html>
