<ul class="menu-left">
  <li>
    <a href="<?php echo $TopDir; ?>products.php">Products</a>
    <ul>
      <?php
      include_once "inc/dbconfig.php";
      
      $msubresult = $mysqli->query("SELECT * FROM products_category WHERE publish = 'on' ORDER BY sort+0 ASC");

      while($msubrow = $msubresult->fetch_array(MYSQLI_ASSOC)) {
        echo "<li><a href=\"" . $TopDir . "products.php?" . $msubrow['id'] . "\">" . $msubrow['name'] . "</a></li>\n";
      }

      $msubresult->close();
      ?>
      <li><a href="<?php echo $TopDir; ?>pdf/Jim's_Cheese_Product_Guide.pdf">Product Guide PDF</a></li>
    </ul>
  </li>
  <li>
    <a href="<?php echo $TopDir; ?>artisan-cheeses.php">Artisan Cheeses</a>
    <ul>
      <li><a href="<?php echo $TopDir; ?>products.php?1">Artisan and Farmstead Cheeses</a></li>
    </ul>
  </li>
  <li><a href="<?php echo $TopDir; ?>where-to-buy.php">Where to Buy</a></li>
</ul>
<ul class="menu-right">
  <li><a href="<?php echo $TopDir; ?>blog">Jim's Blog</a></li>
  <!-- <li><a href="http://www.jimscheesepantry.com">Jim's Pantry</a></li> -->
  <li>
    <a href="<?php echo $TopDir; ?>about.php">About</a>
    <ul>
      <li><a href="<?php echo $TopDir; ?>contact.php">Contact</a></li>
      <li><a href="<?php echo $TopDir; ?>become-a-retailer.php">Become A Retailer</a></li>
<!--       <li><a href="<?php echo $TopDir; ?>customer-service.php">Customer Service</a></li>
      <li><a href="<?php echo $TopDir; ?>customer-service.php#consultants">Sales Consultants</a></li> -->
      <li><a href="<?php echo $TopDir; ?>employment.php">Employment</a></li>
    </ul>
  </li>
  <li class="search"><a href="#search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
</ul>