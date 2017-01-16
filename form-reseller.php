<?php
session_start();

$salt = "JimsCheeseResellerForm";

if ($_POST['confirmationCAP'] == "") {
  if (
      $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('company' . $_POST['ip'] . $salt . $_POST['timestamp'])] != ""
     )
  {
    include_once "inc/dbconfig.php";

    mysql_query("INSERT INTO resellers (email, firstname, lastname, company, zone) VALUES ('" . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "', '" . $_POST[md5('firstname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "', '" . $_POST[md5('lastname' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "', '" . $_POST[md5('company' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "', '" . $_POST['zone'] . "')");
    
    $feedback = "Thank you for your information. We will begin sending updates soon.";
    
    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 200 OK");
      echo $feedback;
    }
  } else {
    $feedback = "<strong>Some required information is missing! Please go back and make sure all required fields are filled.</strong>";

    if (!empty($_REQUEST['src'])) {
      header("HTTP/1.0 500 Internal Server Error");
      echo $feedback;
    }
  }
}

if (empty($_REQUEST['src'])) {
  $_SESSION['feedback'] = $feedback;
  header("Location: " . $_POST['referrer'] . "#reseller-form");
}
?>