<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Jim's Cheese<?php if (isset($PageTitle)) echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Foresite Group">

    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Roboto+Slab:700|Work+Sans:600,800" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="inc/main.css?<?php echo filemtime('inc/main.css'); ?>">

    <script type="text/javascript" src="inc/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="inc/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="inc/jquery.modal.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("a[href^='http'], a[href$='.pdf']").not("[href*='" + window.location.host + "']").attr('target','_blank');

        $(".menu-holder").waypoint(function(direction) {
          $(".scrolling-menu").toggleClass("sticky", direction == "down");
        });

        $('a[href="#search"]').click(function(event) {
          event.preventDefault();
          $(this).modal({ fadeDuration: 200, fadeDelay: 0 });
        });
      });
    </script>
  </head>
  <body>

  <div id="search" style="display: none;">
    <form class="site-width" method="POST" action="search.php">
      <div>
        <input type="text" name="search" placeholder="SEARCH...">
      </div>
    </form>
  </div>

  <div class="jc-header">
    <a href="." id="logo"><img src="images/logo.png" alt=""></a>

    <div class="top-menu">
      <div class="site-width">
        <a href="#">Contact</a>
        <a href="#">Monthly Specials</a>
        <a href="#">Customer Login <i class="fa fa-user" aria-hidden="true"></i></a>
      </div>
    </div>

    <div class="site-width">
      <div class="menu">
        <?php include "menu.php" ?>
      </div>
    </div>
  </div>

  <div class="menu-holder">
    <div class="scrolling-menu">
      <div class="site-width">
        <a href="." id="logo-scrolling"><img src="images/logo-scrolling.png" alt=""></a>
        <input type="checkbox" id="show-menu" role="button">
        <label for="show-menu" id="menu-toggle"></label>
        <div><?php include "menu.php" ?></div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="inc/jquery.cycle2.min.js"></script>
  <div class="cycle-slideshow" data-cycle-slides="> div" data-cycle-timeout="9000" data-cycle-pause-on-hover="true" data-cycle-pager-template="<span></span>">
    <p class="cycle-pager"></p>

    <div style="background-image: url(images/home-banner1.jpg);">
      <div class="overlay">
        <div class="site-width">
          <h2>Jim's Cheese Provides the Highest Quality Wisconsin Cheese Products.</h2>

          Call 800-345-3571 to Receive Special Pricing.<br>
          <br>

          <a href="#" class="arrow-link">FEATURED ITEMS</a>
        </div>
      </div>
    </div>

    <div style="background-image: url(images/home-banner2.jpg);">
      <div class="overlay">
        <div class="site-width">
          <h2>This is the second banner slide.</h2>

          We need to put some content here.<br>
          <br>

          <a href="#" class="arrow-link">SOME LINK</a>
        </div>
      </div>
    </div>

    <div style="background-image: url(images/home-banner3.jpg);">
      <div class="overlay">
        <div class="site-width">
          <h2>The third slide is quite nice.</h2>

          It needs some content as well.<br>
          <br>

          <a href="#" class="arrow-link">ANOTHER LINK</a>
        </div>
      </div>
    </div>

    <div style="background-image: url(images/home-banner4.jpg);">
      <div class="overlay">
        <div class="site-width">
          <h2>And here we all are at the fourth and final slide.</h2>

          But we could add more slides if we wanted to.<br>
          <br>

          <a href="#" class="arrow-link">YET ANOTHER LINK</a>
        </div>
      </div>
    </div>
  </div>

  <div class="home-about">
    <div class="site-width">
      Jim's Cheese is known for its large selection of specialty, aged and cut out cheeses and has been supplying great Wisconsin cheese since 1955.
    </div>
  </div>

  <div class="home-products cf">
    <div style="background-image: url(images/home-product-cutouts.jpg);">
      <a href="#">
        <div class="title">CHEESE CUTOUTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(images/home-product-retail-cuts.jpg);">
      <a href="#">
        <div class="title">RETAIL CUTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(images/home-product-block.jpg);">
      <a href="#">
        <div class="title">BLOCK, LOAF, HORNS &amp; ROUNDS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>

    <div style="background-image: url(images/home-product-gift.jpg);">
      <a href="#">
        <div class="title">GIFT BASKETS &amp; COMPONENTS</div>
        <div class="view-more">VIEW MORE</div>
      </a>
    </div>
  </div>

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

  <div class="home-where">
    <div class="site-width">
      <form action="where-can-i-buy.php?thankyou" method="post">
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
  </div>

  <div class="jc-footer">
    <div class="site-width">
      <div class="left">
        <a href="#">PRODUCTS</a>
        <a href="#">CUSTOMER SERVICE</a>
        <a href="#">CUSTOMER LOGIN</a>
        <a href="#">MONTHLY SPECIALS</a>
        <a href="#">WHERE TO BUY</a>
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