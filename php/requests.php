<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Requests</title>
  <a href="../index.html">Home</a>
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
        var item = $(this).parent().data('item-name');
        var user = $(this).parent().data('username');

        $.post("handleRequests.php", {
            request: "approve",
            item_name: item,
            username: user
          },
          function() {location.reload(true);});
      });

      $('.reject-btn').click(function() {
        var item = $(this).parent().data('item-name');
        var user = $(this).parent().data('username');

        $.post("handleRequests.php", {
            request: "reject",
            item_name: item,
            username: user
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

  require 'modules/databaseConnection.php';

  $stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = '$username'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $result = $stmt->fetchAll()[0]["is_admin"];

  $request_query = "SELECT item_name,username,status,date_resolved,date_submitted,reason FROM requests";

  echo "<table>";
  echo "<tr>";
  echo "<th>item_name</th>";
  echo "<th>username</th>";
  echo "<th>status</th>";
  echo "<th>Date Submitted</th>";
  echo "<th>Date Resolved</th>";
  echo "<th>Reason</th>";

  if ($result == 1) {
    $stmt = $conn->prepare($request_query);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<th>approve/reject</th>";
    echo "</tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo "<tr>";
        echo "<td>" . $v["item_name"] . "</td><td>" . $v["username"] . "</td><td>" . $v["status"] . "</td><td>" . $v["date_submitted"] . "</td><td>" . $v["date_resolved"] . "</td><td>"
        . $v["reason"] . "</td><td>"
        . '<div data-status="'.  $v["status"] . '" data-item-name="' . $v["item_name"] . '" data-username="' .  $v["username"] . '"><input class="approve-btn" type="button" value ="approve")/> <input class="reject-btn" type="button" value ="reject"/></div>'
        . "</td>";
        echo "</tr>";
    }
    echo "</table>";
  }else {
    $stmt = $conn->prepare($request_query . " WHERE username = '$username'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "</tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo "<tr>";
        echo "<td>" . $v["item_name"] . "</td><td>" . $v["username"] . "</td><td>" . $v["status"] . "</td><td>" . $v["date_submitted"] . "</td><td>" . $v["date_resolved"] . "</td><td>" . $v["reason"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
  }
   ?>
</body>

</html>
