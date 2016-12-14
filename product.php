<?php
include_once "inc/dbconfig.php";

$result = $mysqli->query("SELECT * FROM products WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
$row = $result->fetch_array(MYSQLI_ASSOC);

$PageTitle = $row['name'];
$BannerTitle = $row['name'];
$BannerText = "JIM'S CHEESE PROUDLY SINCE 1955";

$CatID = $row['category'];

include "header.php";
?>

<div class="banner" style="background-image: url(images/products-banner.jpg);">
  <div class="site-width">
    <h1><?php echo $BannerTitle; ?></h1>
    <?php echo $BannerText; ?>
  </div>
</div>

<?php if ($_SERVER['QUERY_STRING'] != "") { ?>
<div class="products-menu">
  <h2>PRODUCTS</h2>

  <?php
  $pmresult = $mysqli->query("SELECT * FROM products_category WHERE publish = 'on' ORDER BY sort+0 ASC");

  while($pmrow = $pmresult->fetch_array(MYSQLI_ASSOC)) {
    echo "<a href=\"products.php?" . $pmrow['id'] . "\"";
    if ($pmrow['id'] == $CatID) echo " class=\"current\"";
    echo ">" . $pmrow['name'] . "</a>\n";
  }

  $pmresult->close();
  ?>
</div>
<?php } ?>

<div class="product">
  <strong style="color: red;">INDIVIDUAL PRODUCT PAGE HAS NOT BEEN DESIGNED YET</strong><br><br>
  <?php
  function nl2br_html($string) {
    if(!preg_match("#</.*>#", $string)) return nl2br($string);

    $string = str_replace(array("\r\n", "\r", "\n"), "\n", $string);

    $lines = explode("\n", $string);
    $output = "";
    foreach($lines as $line) {
      $line = rtrim($line);
      if(! preg_match("#</?[^/<>]*>$#", $line)) $line .= "<br>";
      $output .= $line . "\n";
    }

    return $output;
  }

  echo $row['name'] . "<br>";
  echo "<img src=\"images/products/" . $row['image'] . "\" alt=\"\"><br>";
  echo nl2br_html($row['description']);

  $result->close();
  ?>
</div>

<div style="clear: both;"></div>

<?php include "footer.php"; ?>