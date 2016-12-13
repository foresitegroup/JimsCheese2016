<?php
include("../inc/dbconfig.php");

switch ($_REQUEST['a']) {
  case "add":
    $mysqli->query("INSERT INTO products (
                  name,
                  image,
                  description,
                  category,
                  publish
                  ) VALUES(
                  '" . $mysqli->real_escape_string($_POST['name']) . "',
                  '" . $mysqli->real_escape_string($_POST['image']) . "',
                  '" . $mysqli->real_escape_string($_POST['description']) . "',
                  '" . $mysqli->real_escape_string($_POST['category']) . "',
                  '" . $_POST['publish'] . "'
                  )");
    break;
  case "edit":
    $mysqli->query("UPDATE products SET
                  name = '" . $mysqli->real_escape_string($_POST['name']) . "',
                  image = '" . $mysqli->real_escape_string($_POST['image']) . "',
                  description = '" . $mysqli->real_escape_string($_POST['description']) . "',
                  category = '" . $mysqli->real_escape_string($_POST['category']) . "',
                  publish = '" . $mysqli->real_escape_string($_POST['publish']) . "'
                  WHERE id = '" . $_POST['id'] . "'");
    break;
  case "delete":
    $mysqli->query("DELETE FROM products WHERE id = '" . $_GET['id'] . "'");
    break;
  case "toggle":
    $mysqli->query("UPDATE products SET publish = '" . $_POST['pubstate'] . "' WHERE id = " . $_POST['id']);
    break;
}

$mysqli->close();

header( "Location: products.php" );
?>