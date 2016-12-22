
  <div class="products-band cf">
    <div style="background-image: url(images/home-product-cutouts.jpg);">
      <a href="products.php?8">
        <div class="title">CHEESE CUTOUTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(images/home-product-retail-cuts.jpg);">
      <a href="products.php?7">
        <div class="title">RETAIL CUTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(images/home-product-block.jpg);">
      <a href="products.php?5">
        <div class="title">BLOCK, LOAF, HORNS &amp; ROUNDS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(images/home-product-gift.jpg);">
      <a href="products.php?11">
        <div class="title">GIFT BASKETS &amp; COMPONENTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>
  </div>
  
  <?php if (!isset($PageTitle)) { ?>
  <div class="home-artisan">
    <div class="site-width">
      <div class="left">
        <img src="images/lake-forest-artisan.png" alt="">
      </div>

      <div class="right">
        Lake Forest Artisan Cheese represents a family of farmstead, single herd cheeses crafted by Wisconsin artisan cheesemakers. Each cheesemaker has a unique offering of flavors, styles and cultural origin that appeal to cheese enthusiasts throughout the country.<br>
        <br>

        <a href="#" class="arrow-link">ARTISAN CHEESES</a>
      </div>
    </div>
  </div>
  <?php } ?>
  
  <?php if (!isset($wtb)) { ?>
  <div class="footer-where">
    <div class="site-width">
      <form action="where-to-buy.php?thankyou" method="post">
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
        <a href="products.php">PRODUCTS</a>
        <a href="#">CUSTOMER SERVICE</a>
        <a href="#">CUSTOMER LOGIN</a>
        <a href="#">MONTHLY SPECIALS</a>
        <a href="where-to-buy.php">WHERE TO BUY</a>
      </div>

      <div class="right">
        <a href="https://www.facebook.com/JimsCheese"><i class="fa fa-facebook" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
        <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>

        <a href="http://www.eatwisconsincheese.com"><img src="images/wisconsin-cheese-logo.png" alt="Wisconsin Cheese"></a>
      </div>
    </div>
  </div>

  </body>
</html>