<?php
$PageTitle = "Customer Service";
include "header.php";
?>

<div class="banner overlay" style="background-image: url(images/retailer-banner.jpg);">
  <div class="site-width">
    <h1>CUSTOMER SERVICE</h1>
    JIM'S CHEESE PROUDLY SINCE 1955
  </div>
</div>

<div class="address-banner">
  Our office is open Monday - Friday: 8am - 4pm
</div>

<div class="site-width customer-service">
  We pride ourselves on the services we provide to our customers throughout the region and the U.S. To talk to a customer service representative, please call us at:<br>
  <br>

  <div>
    <span class="yellowtext">Phone:</span> 920-478-3571 or 800-345-3571<br>
    <span class="yellowtext">Fax:</span> 920-478-2320
  </div>
</div>

<div class="consultants" id="consultants">
  <div class="site-width">
    <h2>SALES CONSULTANTS</h2>

    <div class="one-third">
      <div class="consultant-image" style="background-image: url(images/consultant-stephanie-ganster.jpg);"></div>

      <h3>Stephanie Ganster</h3>

      <?php email("stephanie@jimscheese.com"); ?><br>
      Ext. 100
    </div>

    <div class="one-third">
      <div class="consultant-image" style="background-image: url(images/consultant-holly-koller.jpg);"></div>

      <h3>Holly Koller</h3>

      <?php email("holly@jimscheese.com"); ?><br>
      Ext. 103
    </div>

    <div class="one-third">
      <div class="consultant-image" style="background-image: url(images/consultant-ray-burbach.jpg);"></div>

      <h3>Ray Burbach</h3>

      <?php email("ray@jimscheese.com"); ?><br>
      Ext. 102
    </div>

    <div class="one-third">
      <div class="consultant-image" style="background-image: url(images/consultant-tammy-ludeman.jpg);"></div>

      <h3>Tammy Ludeman</h3>

      <?php email("tammy@jimscheese.com"); ?><br>
      Ext. 105
    </div>

    <div class="one-third">
      <div class="consultant-image" style="background-image: url(images/consultant-carol-marshall.jpg);"></div>

      <h3>Carol Marshall</h3>

      <?php email("carol@jimscheese.com"); ?><br>
      Ext. 109
    </div>

    <div class="one-third">
      <div class="consultant-image" style="background-image: url(images/consultant-elaine-riege.jpg);"></div>

      <h3>Elaine Riege</h3>

      <?php email("elaine@jimscheese.com"); ?><br>
      Ext. 116
    </div>

    <!-- <div class="one-third bar">
      <div class="bar-content">
         Interested in Becoming a Retailer?<br>
         <br>

         <a href="become-a-retailer.php" class="arrow-link">LEARN MORE</a>
      </div>
    </div> -->
  </div>
</div>

<?php include "footer.php"; ?>