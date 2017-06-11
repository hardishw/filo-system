<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Requests</title>
  <a href="../index.html">Home</a>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#approve-btn').prop('disabled', true);
      $('#reject-btn').prop('disabled', true);
      if ($('#approve-btn').parent().data('status') === 'PENDING') {
        $('#approve-btn').prop('disabled', false);
        $('#reject-btn').prop('disabled', false);
      }

      $('#approve-btn').click(function() {
        var item = $(this).parent().data('item-name');
        var user = $(this).parent().data('username');

        $.post("handleRequests.php", {
            request: "approve",
            item_name: item,
            username: user
          },
          function() {location.reload(true);});
      });

      $('#reject-btn').click(function() {
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
  $username = $_COOKIE["filo-login"];
  //redirects to login page if user is not logged in
  if(empty($username)){
    header('Location: ../html/login.html');
  }

  $conn = new PDO("mysql:host=localhost;dbname=wilkhuh_db", "wilkhuh","rent59deny");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT is_admin FROM users WHERE username = '$username'");
  $stmt->execute();
  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $result = $stmt->fetchAll()[0]["is_admin"];

  if ($result == 1) {
    $stmt = $conn->prepare("SELECT item_name,username,status,date_resolved FROM requests");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>item_name</th>";
    echo "<th>username</th>";
    echo "<th>status</th>";
    echo "<th>Date Submitted</th>";
    echo "<th>Date Resolved</th>";
    echo "<th>approve/reject</th>";
    echo "</tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo "<tr>";
        echo "<td>" . $v["item_name"] . "</td><td>" . $v["username"] . "</td><td>" . $v["status"] . "</td><td>" . $v["date_submitted"] . "</td><td>" . $v["date_resolved"] . "</td><td>"
        . '<div data-status="'.  $v["status"] . '" data-item-name="' . $v["item_name"] . '" data-username="' .  $v["username"] . '"><input id="approve-btn" type="button" value ="approve")/> <input id="reject-btn" type="button" value ="reject"/></div>'
        . "</td>";
        echo "</tr>";
    }
    echo "</table>";
  }else {
    $stmt = $conn->prepare("SELECT item_name,username,status FROM requests WHERE username = '$username'");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    echo "<table>";
    echo "<tr>";
    echo "<th>item_name</th>";
    echo "<th>username</th>";
    echo "<th>status</th>";
    echo "<th>Date Submitted</th>";
    echo "<th>Date Resolved</th>";
    echo "</tr>";
	  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
        echo "<tr>";
        echo "<td>" . $v["item_name"] . "</td><td>" . $v["username"] . "</td><td>" . $v["status"] . "</td><td>" . $v["date_submitted"] . "</td><td>" . $v["date_resolved"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
  }
   ?>
</body>

</html>
