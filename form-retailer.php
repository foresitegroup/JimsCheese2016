<?php
session_start();

$salt = "JimsCheeseRetailerForm";

if ($_POST['confirmationCAP'] == "") {
  if (
      $_POST[md5('name' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('phone' . $_POST['ip'] . $salt . $_POST['timestamp'])] != "" &&
      $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] != ""
     )
  {
    // Send email
    $Subject = "Contact From Website";
    $SendTo = "info@jimscheese.com";
    $Headers = "From: Retailer Form <retailerform@jimscheese.com>\r\n";
    $Headers .= "Reply-To: " . $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\r\n";
    $Headers .= "Bcc: mark@foresitegrp.com\r\n";

    $Message = $_POST[md5('name' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    if (!empty($_POST[md5('company' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('company' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    if (!empty($_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('address' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    if (!empty($_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('address2' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    if (!empty($_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])];
    if (!empty($_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])]) && !empty($_POST['state'])) $Message .= ", ";
    if (!empty($_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])];
    if (!empty($_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])]) || !empty($_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])]) && !empty($_POST['zip'])) $Message .= " ";
    if (!empty($_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])];
    if (!empty($_POST[md5('city' . $_POST['ip'] . $salt . $_POST['timestamp'])]) || !empty($_POST[md5('state' . $_POST['ip'] . $salt . $_POST['timestamp'])]) || !empty($_POST[md5('zip' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= "\n";

    $Message .= "\n";

    if (!empty($_POST[md5('phone' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('phone' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";
    if (!empty($_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])])) $Message .= $_POST[md5('email' . $_POST['ip'] . $salt . $_POST['timestamp'])] . "\n";

    $Message .= "\n";

    if (!empty($_POST['store'])) $Message .= "Type of Store(s): " . implode(", ", $_POST['store']) . "\n";

    $Message = stripslashes($Message);
  
    mail($SendTo, $Subject, $Message, $Headers);
    
    $feedback = "Thank you for your interest in Jim's Cheese. You will be contacted soon.";
    
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
  header("Location: " . $_POST['referrer'] . "#retailer-form");
}
?>