<?php
include "resellers-login.php";
$PageTitle = "Product and Price Guides";
include "header.php";
?>

<div class="banner overlay" style="background-image: url(images/retailer-banner.jpg);">
  <div class="site-width">
    <h1>PRODUCT AND PRICE GUIDES</h1>
    JIM'S CHEESE PROUDLY SINCE 1955
  </div>
</div>

<div class="site-width resellers">
  Welcome to Jim's Cheese product and price guides. To talk to a customer service representative, please call us at 920-478-3571 or 800-345-3571 and fax us at 920-478-2320. To view our price lists, please click the links directly below.<br>
  <br>

  <div style="text-align: center;">
    <?php if ($ThePassword == $Zone1Password) { $zone = 1; ?>
    <a href="pdf/resellers/JCPricingV1.pdf">Jim's Cheese Pricing</a><br>
    <a href="pdf/resellers/LFAPricingV1.pdf">Lake Forest Artisan Pricing</a><br>
    <a href="pdf/resellers/CutoutsPricingV1.pdf">Cutouts Pricing</a><br>
    <?php } ?>
    
    <?php if ($ThePassword == $Zone2Password) { $zone = 2; ?>
    <a href="pdf/resellers/JCPricingV2.pdf">Jim's Cheese Pricing</a><br>
    <a href="pdf/resellers/LFAPricingV2.pdf">Lake Forest Artisan Pricing</a><br>
    <a href="pdf/resellers/CutoutsPricingV2.pdf">Cutouts Pricing</a><br>
    <?php } ?>
    
    <?php if ($ThePassword == $Zone3Password) { $zone = 3; ?>
    <a href="pdf/resellers/JCPricingV3.pdf">Jim's Cheese Pricing</a><br>
    <a href="pdf/resellers/LFAPricingV3.pdf">Lake Forest Artisan Pricing</a><br>
    <a href="pdf/resellers/CutoutsPricingV3.pdf">Cutouts Pricing</a><br>
    <?php } ?>
    
    <?php if ($ThePassword == $Zone4Password) { $zone = 4; ?>
    <a href="pdf/resellers/JCPricingV4.pdf">Jim's Cheese Pricing</a><br>
    <a href="pdf/resellers/LFAPricingV4.pdf">Lake Forest Artisan Pricing</a><br>
    <a href="pdf/resellers/CutoutsPricingV4.pdf">Cutouts Pricing</a><br>
    <?php } ?>
    
    <a href="pdf/Jim's_Cheese_Brochure.pdf">Brochure</a><br>
    <a href="pdf/resellers/<?php echo $GLOBALS['MonthlySpecials']; ?>.pdf"><?php echo $GLOBALS['MonthlySpecialsTitle']; ?></a>
  </div><br>
  <br>

  To receive notices of Jim's Cheese monthly specials, discounted items and information on new products, please submit your information below. Your information will be kept private and not be given or sold to third parties.<br>

  <script type="text/javascript">
    $(document).ready(function() {
      var form = $('#reseller-form');
      var formMessages = $('#form-messages');
      $(form).submit(function(event) {
        event.preventDefault();
        
        function formValidation() {
          if ($('#email').val() === '') { alert('Email required.'); $('#email').focus(); return false; }
          if ($('#firstname').val() === '') { alert('First Name required.'); $('#firstname').focus(); return false; }
          if ($('#lastname').val() === '') { alert('Last Name required.'); $('#lastname').focus(); return false; }
          if ($('#company').val() === '') { alert('Company required.'); $('#company').focus(); return false; }
          return true;
        }
        
        if (formValidation()) {
          var formData = $(form).serialize();
          formData += '&src=ajax';

          $.ajax({
            type: 'POST',
            url: $(form).attr('action'),
            data: formData
          })
          .done(function(response) {
            $(formMessages).html(response);

            $(form).find('input:text').val('');
            $('#email').val(''); // Grrr!
          })
          .fail(function(data) {
            if (data.responseText !== '') {
              $(formMessages).html(data.responseText);
            } else {
              $(formMessages).text('Oops! An error occured and your message could not be sent.');
            }
          });
        }
      });
    });
  </script>

  <?php
  // Settings for randomizing form field names
  $ip = $_SERVER['REMOTE_ADDR'];
  $timestamp = time();
  $salt = "JimsCheeseResellerForm";
  ?>

  <noscript>
  <?php
  $feedback = (!empty($_SESSION['feedback'])) ? $_SESSION['feedback'] : "";
  unset($_SESSION['feedback']);
  ?>
  </noscript>

  <form action="form-reseller.php" method="POST" id="reseller-form">
    <div>
      <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="EMAIL">

      <input type="text" name="<?php echo md5("firstname" . $ip . $salt . $timestamp); ?>" id="firstname" placeholder="FIRST NAME">

      <input type="text" name="<?php echo md5("lastname" . $ip . $salt . $timestamp); ?>" id="lastname" placeholder="LAST NAME">

      <input type="text" name="<?php echo md5("company" . $ip . $salt . $timestamp); ?>" id="company" placeholder="COMPANY">

      <input type="hidden" name="zone" value="<?php echo $zone; ?>">

      <input type="hidden" name="referrer" value="resellers.php">

      <input type="text" name="confirmationCAP" style="display: none;">

      <input type="hidden" name="ip" value="<?php echo $ip; ?>">
      <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

      <div id="form-messages"><?php echo $feedback; ?></div>

      <input type="submit" name="submit" value="SUBMIT">
    </div>
  </form>
</div>

<?php include "footer.php"; ?>