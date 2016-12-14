<?php
$PageTitle = "Products";

include_once "inc/dbconfig.php";

if ($_SERVER['QUERY_STRING'] == "") {
  $result = $mysqli->query("SELECT * FROM products_category WHERE publish = 'on' ORDER BY sort+0 ASC");
  $BannerTitle = "JIM'S CHEESE PRODUCTS";
  $BannerText = "WISCONSIN'S FINEST";
  $PageLink = "products.php";
} else {
  $result = $mysqli->query("SELECT * FROM products_category WHERE id = '" . $_SERVER['QUERY_STRING'] . "'");
  $row = $result->fetch_array(MYSQLI_ASSOC);

  $CatID = $row['id'];
  $CatName = $row['name'];

  $result->close();

  $PageTitle .= " | " . $CatName;
  $BannerTitle = $CatName;
  $BannerText = "JIM'S CHEESE PROUDLY SINCE 1955";
  $PageLink = "product.php";

  $result = $mysqli->query("SELECT * FROM products WHERE category = '" . $CatID . "' AND publish = 'on' ORDER BY name ASC");
}

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

<div class="products<?php if ($_SERVER['QUERY_STRING'] != "") echo " products-single"; ?>">
  <?php
  while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    echo "
    <a href=\"" . $PageLink . "?" . $row['id'] . "\">
    <div style=\"background-image: url(images/products/" . $row['image'] . ");\"></div>
    " . $row['name'] . "
    </a>
    ";
  }

  $result->close();
  ?>
</div>

<div style="clear: both;"></div>

<?php include "footer.php"; ?>