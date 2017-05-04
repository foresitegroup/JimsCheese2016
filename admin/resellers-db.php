<?php
include "../inc/dbconfig.php";

switch ($_GET['a']) {
  case "delete":
    $mysqli->query("DELETE FROM resellers WHERE id = '" . $_GET['id'] . "'");
    break;
}

$mysqli->close();

header( "Location: resellers.php" );
?>