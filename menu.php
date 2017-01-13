<ul class="menu-left">
  <li>
    <a href="products.php">Products</a>
    <ul>
      <?php
      include_once "inc/dbconfig.php";
      
      $msubresult = $mysqli->query("SELECT * FROM products_category WHERE publish = 'on' ORDER BY sort+0 ASC");

      while($msubrow = $msubresult->fetch_array(MYSQLI_ASSOC)) {
        echo "<li><a href=\"products.php?" . $msubrow['id'] . "\">" . $msubrow['name'] . "</a></li>\n";
      }

      $msubresult->close();
      ?>
    </ul>
  </li>
  <li>
    <a href="artisan-cheeses.php">Artisan Cheeses</a>
    <ul>
      <li><a href="products.php?1">Lake Forest Artisan</a></li>
    </ul>
  </li>
  <li><a href="where-to-buy.php">Where to Buy</a></li>
</ul>
<ul class="menu-right">
  <li><a href="#">Jim's Blog</a></li>
  <li><a href="http://www.jimscheesepantry.com">Jim's Pantry</a></li>
  <li>
    <a href="about.php">About</a>
    <ul>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="become-a-retailer.php">Become A Retailer</a></li>
    </ul>
  </li>
  <li class="search"><a href="#search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
</ul>