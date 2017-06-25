<!DOCTYPE html>
<html>

<head>
  <title>FiLo System - Edit Item</title>
  <h2>Edit Item</h2>
  <link rel="stylesheet" type="text/css" href="../css/table.css">
  <?php
  require 'modules/header.php';
  require 'modules/validateAdmin.php';
  ?>
</head>

<body>
  <form action="updateItem.php" method="post" enctype="multipart/form-data">
    <table>
      <tr>
        <th>Column Name</th>
        <th>Current Value</th>
        <th>New Value</th>
      </tr>
      <?php
        $item_id = $_POST["item-id"];

        require 'modules/databaseConnection.php';
        $stmt = $conn->prepare("SELECT * FROM lost_items WHERE id = '$item_id'");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $result =  $stmt->fetchAll()[0];

        echo "<tr><td>ID</td> <td>{$result["id"]}</td> <td><input type='hidden' name='id' size='15' maxlength='15' value='{$result["id"]}'></td></tr>";
        echo "<tr><td>Item Name</td> <td>{$result["item_name"]}</td> <td><input type='text' name='item-name' size='20' maxlength='15'></td></tr>";
        echo "<tr><td>Description</td> <td>{$result["description"]}</td> <td><textarea name='description' cols='40' rows='5' maxlength='255'></textarea></tr>";
        echo "<tr><td>Date Found</td> <td>{$result["date_found"]}</td> <td><input type='date' name='date-found'></td></tr>";
        echo "<tr><td>Category</td> <td>{$result['category']}</td> <td><input type='radio' name='category' value='Pets'> Pets
          <input type='radio' name='category' value='Electronics'> Electronics
          <input type='radio' name='category' value='Jewellery'> Jewellery</td></tr>";
        echo "<tr><td>User</td> <td>{$result["user"]}</td> <td><input type='text' name='user' size='15' maxlength='20'></td></tr>";
        echo "<tr><td>Place Found</td> <td>{$result["place_found"]}</td> <td><input type='text' name='place-found' size='15' maxlength='100'></td></tr>";
        echo "<tr><td>Colour</td> <td>{$result["colour"]}</td> <td><input type='text' name='colour' size='15' maxlength='20'></td></tr>";
        echo "<tr><td>Image</td> <td><img src='{$result['image_path']}' alt='item image' width=\"100\" height=\"100\"></td> <td><input type='file' name='fileToUpload' id='fileToUpload'></td></tr>";

       ?>
    </table>

    <br>
    <br>
    <input type="submit" name="update" value="Update Item">

  </form>
</body>


</html>
