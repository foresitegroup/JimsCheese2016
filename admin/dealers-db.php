<?php
include "../inc/dbconfig.php";

if ($_GET['a'] != "delete" && $_POST['latitude'] == "" || $_POST['longitude'] == "") {
  $address = str_replace(" ", "+", $_POST['address']."+".$_POST['city']."+".$_POST['state']."+".$_POST['zip']);

  $json = file_get_contents("https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false$key=$GoogleAPI");
  $json = json_decode($json);

  $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
  $lon = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
} else {
  $lat = $_POST['latitude'];
  $lon = $_POST['longitude'];
}

switch ($_GET['a']) {
  case "add":
    $mysqli->query("INSERT INTO where_to_buy (
                customer,
                address,
                city,
                state,
                zip,
                telephone,
                latitude,
                longitude
                ) VALUES (
                '" . $mysqli->real_escape_string($_POST['customer']) . "',
                '" . $mysqli->real_escape_string($_POST['address']) . "',
                '" . $mysqli->real_escape_string($_POST['city']) . "',
                '" . $_POST['state'] . "',
                '" . $_POST['zip'] . "',
                '" . $_POST['telephone'] . "',
                '" . $lat . "',
                '" . $lon . "'
                )");
    break;
  case "edit":
    $mysqli->query("UPDATE where_to_buy SET
                customer = '" . $mysqli->real_escape_string($_POST['customer']) . "',
                address = '" . $mysqli->real_escape_string($_POST['address']) . "',
                city = '" . $mysqli->real_escape_string($_POST['city']) . "',
                state = '" . $_POST['state'] . "',
                zip = '" . $_POST['zip'] . "',
                telephone = '" . $_POST['telephone'] . "',
                latitude = '" . $lat . "',
                longitude = '" . $lon . "'
                WHERE id = '" . $_POST['id'] . "'");
    break;
  case "delete":
    $mysqli->query("DELETE FROM where_to_buy WHERE id = '" . $_GET['id'] . "'");
    break;
}

$mysqli->close();

header( "Location: dealers.php" );
?>