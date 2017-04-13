<?php
include("../inc/dbconfig.php");

switch ($_REQUEST['a']) {
  case "add":
    $mysqli->query("INSERT INTO products_category (
                  name,
                  image,
                  publish
                  ) VALUES(
                  '" . $_POST['name'] . "',
                  '" . $_POST['image'] . "',
                  '" . $_POST['publish'] . "'
                  )");
    break;
  case "edit":
    $mysqli->query("UPDATE products_category SET
                  name = '" . $_POST['name'] . "',
                  image = '" . $_POST['image'] . "',
                  publish = '" . $_POST['publish'] . "'
                  WHERE id = '" . $_POST['id'] . "'");
    break;
  case "delete":
    $mysqli->query("DELETE FROM products_category WHERE id = '" . $_GET['id'] . "'");
    break;
  case "sort":
    $i = 1;
    foreach ($_POST['item'] as $value) {
      $mysqli->query("UPDATE products_category SET sort = $i WHERE id = $value");
      $i++;
    }
    break;
  case "toggle":
    $mysqli->query("UPDATE products_category SET publish = '" . $_POST['pubstate'] . "' WHERE id = " . $_POST['id']);
    break;
}

$mysqli->close();

header( "Location: product-cats.php" );
?>