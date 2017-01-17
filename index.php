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

<?php include "footer.php"; ?>