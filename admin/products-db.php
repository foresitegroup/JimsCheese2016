<?php
include("../inc/dbconfig.php");

$direct = "";

switch ($_REQUEST['a']) {
  case "add":
    $mysqli->query("INSERT INTO products (
                  name,
                  image,
                  description,
                  category,
                  publish
                  ) VALUES (
                  '" . $_POST['name'] . "',
                  '" . $_POST['image'] . "',
                  '" . $_POST['description'] . "',
                  '" . $_POST['category'] . "',
                  '" . $_POST['publish'] . "'
                  )");
    $direct = "?" . $_POST['category'];
    break;
  case "edit":
    $mysqli->query("UPDATE products SET
                  name = '" . $_POST['name'] . "',
                  image = '" . $_POST['image'] . "',
                  description = '" . $_POST['description'] . "',
                  category = '" . $_POST['category'] . "',
                  publish = '" . $_POST['publish'] . "'
                  WHERE id = '" . $_POST['id'] . "'");
    $direct = "?" . $_POST['category'];
    break;
  case "delete":
    $mysqli->query("DELETE FROM products WHERE id = '" . $_GET['id'] . "'");
    break;
  case "toggle":
    $mysqli->query("UPDATE products SET publish = '" . $_POST['pubstate'] . "' WHERE id = " . $_POST['id']);
    break;
}

$mysqli->close();

header( "Location: products.php" . $direct );
?>