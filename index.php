<!DOCTYPE html>
<html>

<head>
  <title>FiLo System</title>
  <h2>FiLo System</h2>
  <?php require 'php/modules/header.php'; ?>
  <style type="text/css">
    fieldset {
      display: inline-block;
    }
  </style>
</head>

<body>

  <form action="/php/search.php" method="post">

    <?php
    if (!empty($_COOKIE["username"])) {
      echo '<div>
        <fieldset>
          <legend>Search:</legend>
          <p>
            Search:
            <input type="text" name="search" size="15" maxlength="50">
          </p>
        </fieldset>
      </div>
      <div>
        <fieldset>
          <legend>Time Frame Lost:</legend>
          <p>
            Date min:
            <input type="date" name="date_min">
          </p>
          <p>
            Date max:
            <input type="date" name="date_max">
          </p>
        </fieldset>
      </div>';
    }
    ?>
    <div>
      <fieldset>
        <legend>Category:</legend>
        <input type="radio" name="category" value="Pets"> Pets
        <input type="radio" name="category" value="Electronics"> Electronics
        <input type="radio" name="category" value="Jewellery"> Jewellery
      </fieldset>
    </div>
    <p>
      <input type="submit" name="submit" value="Search">
    </p>
  </form>
</body>

</html>
