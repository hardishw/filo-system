<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Requests</title>
  <h2>Requests</h2>
  <?php require 'modules/header.php'; ?>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.approve-btn').prop('disabled', true);
      $('.reject-btn').prop('disabled', true);

      $( ".approve-btn" ).each(function() {
        if ($(this).parent().data('status') === 'PENDING') {
          $(this).prop('disabled', false);
        }
      });

      $( ".reject-btn" ).each(function() {
        if ($(this).parent().data('status') === 'PENDING') {
          $(this).prop('disabled', false);
        }
      });


      $('.approve-btn').click(function() {
        var item = $(this).parent().data('id');

        $.post("handleRequests.php", {
            request: "approve",
            request_id: item
          },
          function() {location.reload(true);});
      });

      $('.reject-btn').click(function() {
        var item = $(this).parent().data('id');

        $.post("handleRequests.php", {
            request: "reject",
            request_id: item
          },
          function() {location.reload(true);});
      });

    });
  </script>
</head>

<body>

  <?php
  //redirects to login page if user is not logged in
  require 'modules/validateUser.php';
  $username = $_COOKIE["username"];
  $order_by = $_POST["order_by"];
  $order_direction = $_POST["order_direction"];

  require 'modules/databaseConnection.php';

  $stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = '$username'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $result = $stmt->fetchAll()[0]["is_admin"];

  $query = "SELECT id,item_name,username,status,date_resolved,date_submitted,reason FROM requests";

  if ($result == 0) {
    $query = $query . " WHERE username = '$username'";
  }
  if (!empty($order_by)) {
    $query = $query . " ORDER BY $order_by $order_direction";
  }

  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  echo "<form action='requests.php' method='post'>
  Order By:  <select name='order_by'>
  <option value='id'>Request ID</option>
  <option value='item_name'>Item Name</option>
  <option value='username'>Username</option>
  <option value='status'>Status</option>
  <option value='date_submitted'>Date Submitted</option>
  <option value='date_resolved'>Date Resolved</option>
  <option value='reason'>Reason</option>
  </select>  <select name='order_direction'>
  <option value='ASC'>Ascending</option>
  <option value='DESC'>Descending</option>
  </select>  <input type='submit'>
  <br>
  <br>
  </form>";

  echo "<table>";
  echo "<tr>";
  echo "<th>Request ID</th>";
  echo "<th>Item Name</th>";
  echo "<th>Username</th>";
  echo "<th>Status</th>";
  echo "<th>Date Submitted</th>";
  echo "<th>Date Resolved</th>";
  echo "<th>Reason</th>";

  if ($result == 1) {
    echo "<th>approve/reject</th>";
    echo "</tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo "<tr>";
        echo "<td>" . $v["id"] . "</td><td>" . $v["item_name"] . "</td><td>" . $v["username"] . "</td><td>" . $v["status"] . "</td><td>" . $v["date_submitted"] . "</td><td>" . $v["date_resolved"] . "</td><td>"
        . $v["reason"] . "</td><td>"
        . '<div data-status="'.  $v["status"] . '" data-id="' . $v["id"] . '"><input class="approve-btn" type="button" value ="approve")/> <input class="reject-btn" type="button" value ="reject"/></div>'
        . "</td>";
        echo "</tr>";
    }
    echo "</table>";
  }else {
    echo "</tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo "<tr>";
        echo "<td>" . $v["id"] . "</td><td>" . $v["item_name"] . "</td><td>" . $v["username"] . "</td><td>" . $v["status"] . "</td><td>" . $v["date_submitted"] . "</td><td>" . $v["date_resolved"] . "</td><td>" . $v["reason"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
  }
   ?>
</body>

<footer>
  <br>
  <br>
  <a href="../index.php">Home</a>
</footer>

</html>
