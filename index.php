<?php
$lfa = "yes";
include "header.php";
?>

<script type="text/javascript" src="inc/jquery.cycle2.min.js"></script>
<div class="cycle-slideshow" data-cycle-slides="> div" data-cycle-timeout="9000" data-cycle-pause-on-hover="true" data-cycle-pager-template="<span></span>">
  <p class="cycle-pager"></p>

  <div style="background-image: url(images/home-banner1.jpg);">
    <div class="overlay">
      <div class="site-width">
        <h2>Providing Wisconsin's Finest Cheese since 1955.</h2>

        Call 800-345-3571 to Receive Special Pricing.<br>
        <br>

        <a href="#" class="arrow-link">FEATURED ITEMS</a>
      </div>
    </div>
  </div>

  <div style="background-image: url(images/home-banner2.jpg);">
    <div class="overlay">
      <div class="site-width">
        <h4>Jim's Cheese is the &ldquo;Cheese Cutout Capitol of the World&rdquo; Featuring over 250 Cutouts, Made to Order Logos, Mascots &amp; Themes!</h4>

        <a href="products.php?8" class="arrow-link">VIEW CUTOUTS</a>
      </div>
    </div>
  </div>

  <div style="background-image: url(images/home-banner3.jpg);">
    <div class="overlay">
      <div class="site-width">
        <h3>We carry the largest selection of Wisconsin Artisan &amp; Farmstead Cheeses</h3>

        <a href="artisan-cheeses.php" class="arrow-link">ARTISAN CHEESES</a>
      </div>
    </div>
  </div>

  <div style="background-image: url(images/home-banner4.jpg);">
    <div class="overlay">
      <div class="site-width">
        <h3>We carry the largest variety of sausages, spreads, sauces &amp; snack products</h3>

        <a href="products.php" class="arrow-link">VIEW MORE</a>
      </div>
    </div>
  </div>
</div>

<div class="home-about">
  <div class="site-width">
    Jim's Cheese is known for its large selection of specialty, aged and cut out cheeses and has been supplying great Wisconsin cheese since 1955.
  </div>
</div>

<?php include "footer.php"; ?>