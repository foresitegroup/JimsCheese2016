
  <div class="products-band cf">
    <div style="background-image: url(<?php echo $TopDir; ?>images/home-product-cutouts.jpg);">
      <a href="products.php?8">
        <div class="title">CHEESE CUTOUTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(<?php echo $TopDir; ?>images/home-product-retail-cuts.jpg);">
      <a href="products.php?7">
        <div class="title">RETAIL CUTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(<?php echo $TopDir; ?>images/home-product-block.jpg);">
      <a href="products.php?5">
        <div class="title">BLOCK, LOAF, HORNS &amp; ROUNDS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(<?php echo $TopDir; ?>images/home-product-gift.jpg);">
      <a href="products.php?11">
        <div class="title">GIFT BASKETS &amp; COMPONENTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>
  </div>
  
  <?php if (isset($lfa)) { ?>
  <div class="home-artisan">
    <div class="site-width">
      <div class="left">
        <img src="<?php echo $TopDir; ?>images/lake-forest-artisan.png" alt="">
      </div>

      <div class="right">
        Lake Forest Artisan Cheese represents a family of farmstead, single herd cheeses crafted by Wisconsin artisan cheesemakers. Each cheesemaker has a unique offering of flavors, styles and cultural origin that appeal to cheese enthusiasts throughout the country.<br>
        <br>

        <a href="<?php echo $TopDir; ?>artisan-cheeses.php" class="arrow-link">ARTISAN CHEESES</a>
      </div>
    </div>
  </div>
  <?php } ?>
  
  <?php if (!isset($wtb)) { ?>
  <div class="footer-where">
    <div class="site-width">
      <form action="<?php echo $TopDir; ?>where-to-buy.php?thankyou" method="post">
        <div>
          <span>WHERE CAN I BUY?</span>

          <input type="text" name="zip" placeholder="ENTER ZIP CODE">

          <div class="select">
            <select name="distance">
              <option value="5">5 MILES</option>
              <option value="10">10 MILES</option>
              <option value="25">25 MILES</option>
              <option value="50">50 MILES</option>
              <option value="100">100 MILES</option>
            </select>
          </div>

          <input type="submit" name="submit" value="FIND RETAILER">
        </div>
      </form>
    </div>
    <?php } ?>
  </div>

  <div class="jc-footer">
    <div class="site-width">
      <div class="left">
        <a href="<?php echo $TopDir; ?>products.php">PRODUCTS</a>
        <!-- <a href="<?php echo $TopDir; ?>customer-service.php">CUSTOMER SERVICE</a> -->
        <a href="<?php echo $TopDir; ?>resellers.php">CUSTOMER LOGIN</a>
        <!-- <a href="<?php echo $TopDir; ?>pdf/resellers/<?php echo $GLOBALS['MonthlySpecials']; ?>.pdf">MONTHLY SPECIALS</a> -->
        <a href="<?php echo $TopDir; ?>where-to-buy.php">WHERE TO BUY</a>
      </div>

      <div class="right">
        <a href="https://www.facebook.com/JimsCheese"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="https://twitter.com/JimsCheese"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="https://www.instagram.com/jimscheesewi/"><i class="fa fa-instagram" aria-hidden="true"></i></a>

        <a href="http://www.eatwisconsincheese.com"><img src="<?php echo $TopDir; ?>images/wisconsin-cheese-logo.png" alt="Wisconsin Cheese"></a>
      </div>
    </div>
  </div>

  </body>
</html>