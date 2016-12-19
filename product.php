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

<div class="product cf">
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

  $ShareLink = "http://" . $_SERVER["SERVER_NAME"];
  if ($_SERVER["SERVER_PORT"] != "80") $ShareLink .= ":".$_SERVER["SERVER_PORT"];
  $ShareLink .= $_SERVER["REQUEST_URI"];
  $ShareLink = urlencode($ShareLink);

  $ShareText = $ShareText = urlencode("Jim's Cheese | " . $row['name']);
  ?>

  <div class="product-left">
    <img src="images/products/<?php echo $row['image']; ?>" alt="">
  </div>

  <div class="product-right">
    <?php echo nl2br_html($row['description']); ?>
  </div>
</div>

<div class="product-share">
  SHARE PRODUCT:
  <a href="https://facebook.com/sharer/sharer.php?u=<?php echo $ShareLink; ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
  <a href="https://twitter.com/intent/tweet?url=<?php echo $ShareLink; ?>&text=<?php echo $ShareText; ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
</div>

<?php include "footer.php"; ?>