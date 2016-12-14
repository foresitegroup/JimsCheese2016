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
    <a href="#">Artisan Cheese</a>
    <ul>
      <li><a href="#">Lake Forest Artisan</a></li>
    </ul>
  </li>
  <li><a href="where-to-buy.php">Where to Buy</a></li>
</ul>
<ul class="menu-right">
  <li><a href="#">Jim's Blog</a></li>
  <li><a href="#">Jim's Pantry</a></li>
  <li><a href="#">About</a></li>
  <li class="search"><a href="#search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
</ul>