<?php
include "../inc/dbconfig.php";

switch ($_GET['a']) {
  case "add":
    $mysqli->query("INSERT INTO `where_to_buy` (
                customer,
                address,
                city,
                state,
                zip,
                telephone,
                latitude,
                longitude
                ) VALUES (
                '" . mysql_real_escape_string($_POST['customer']) . "',
                '" . mysql_real_escape_string($_POST['address']) . "',
                '" . mysql_real_escape_string($_POST['city']) . "',
                '" . $_POST['state'] . "',
                '" . $_POST['zip'] . "',
                '" . $_POST['telephone'] . "',
                '" . $_POST['latitude'] . "',
                '" . $_POST['longitude'] . "'
                )");
    break;
  case "edit":
    $mysqli->query("UPDATE where_to_buy SET
                customer = '" . mysql_real_escape_string($_POST['customer']) . "',
                address = '" . mysql_real_escape_string($_POST['address']) . "',
                city = '" . mysql_real_escape_string($_POST['city']) . "',
                state = '" . $_POST['state'] . "',
                zip = '" . $_POST['zip'] . "',
                telephone = '" . $_POST['telephone'] . "',
                latitude = '" . $_POST['latitude'] . "',
                longitude = '" . $_POST['longitude'] . "'
                WHERE id = '" . $_POST['id'] . "'");
    break;
  case "delete":
    $mysqli->query("DELETE FROM where_to_buy WHERE id = '" . $_GET['id'] . "'");
    break;
}

$mysqli->close();

header( "Location: dealers.php" );
?>