<?php
$PageTitle = "Become A Retailer";
include "header.php";
?>

<!-- BEGIN Google Conversion -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1008631094;
var google_conversion_language = "en";
var google_conversion_format = "2";
var google_conversion_color = "ffffff";
var google_conversion_label = "ukuYCPrj4wMQtvr54AM";
var google_conversion_value = 0;
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1008631094/?value=0&amp;label=ukuYCPrj4wMQtvr54AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- END Google Conversion -->

<div class="banner overlay" style="background-image: url(images/retailer-banner.jpg);">
  <div class="site-width">
    <h1>BECOME A RETAILER</h1>
    JIM'S CHEESE PROUDLY SINCE 1955
  </div>
</div>

<div class="site-width retailer-content">
  Becoming a member of the Jim's Cheese retail family is more than just profitable. Our quality line cheeses, cheese cutouts, artisan cheeses and deli cheeses will make your cooler the destination for quality Wisconsin products. Jim's Cheese and the products we represent will make a great addition to your store's product line.<br>
  <br>

  <span style="font-size: 16px;">For more information please fill in the following form and a Jim's Cheese representative will contact you.</span>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var form = $('#retailer-form');
    var formMessages = $('#retailer-form-messages');
    $(form).submit(function(event) {
      event.preventDefault();
      
      function formValidation() {
        if ($('#name').val() === '') { alert('Name required.'); $('#name').focus(); return false; }
        if ($('#phone').val() === '') { alert('Phone required.'); $('#phone').focus(); return false; }
        if ($('#email').val() === '') { alert('Email required.'); $('#email').focus(); return false; }
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

          $(form).find('input:text, textarea').val('');
          $('#email').val(''); // Grrr!
          $(form).find('input:radio, input:checked').removeAttr('checked').removeAttr('selected');
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
$salt = "JimsCheeseRetailerForm";
?>

<noscript>
<?php
$feedback = (!empty($_SESSION['feedback'])) ? $_SESSION['feedback'] : "";
unset($_SESSION['feedback']);
?>
</noscript>

<form action="form-retailer.php" method="POST" id="retailer-form">
  <div>
    <div class="required">* Required</div>

    <input type="text" name="<?php echo md5("name" . $ip . $salt . $timestamp); ?>" id="name" placeholder="Name *">

    <input type="text" name="<?php echo md5("company" . $ip . $salt . $timestamp); ?>" id="company" placeholder="Company">

    <input type="text" name="<?php echo md5("address" . $ip . $salt . $timestamp); ?>" id="address" placeholder="Address">

    <input type="text" name="<?php echo md5("address2" . $ip . $salt . $timestamp); ?>" id="address2" placeholder="Address 2">

    <input type="text" name="<?php echo md5("city" . $ip . $salt . $timestamp); ?>" id="city" placeholder="City">

    <input type="text" name="<?php echo md5("state" . $ip . $salt . $timestamp); ?>" id="state" placeholder="State">

    <input type="text" name="<?php echo md5("zip" . $ip . $salt . $timestamp); ?>" id="zip" placeholder="Zip">

    <div style="clear: both;"></div>

    <input type="text" name="<?php echo md5("phone" . $ip . $salt . $timestamp); ?>" id="phone" placeholder="Phone *">

    <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="Email *">

    <div style="clear: both;"></div>
    
    <div class="label">Type of Store(s)</div>
    <div class="one-fourth">
      <input type="checkbox" name="store[]" value="Gift" id="c1">
      <label for="c1">Gift</label><br>
      <input type="checkbox" name="store[]" value="Grocery" id="c2">
      <label for="c2">Grocery</label><br>
      <input type="checkbox" name="store[]" value="Quick Mart" id="c3">
      <label for="c3">Quick Mart</label>
    </div>

    <div class="one-fourth">
      <input type="checkbox" name="store[]" value="Deli" id="c4">
      <label for="c4">Deli</label><br>
      <input type="checkbox" name="store[]" value="Specialty Food" id="c5">
      <label for="c5">Specialty Food</label><br>
      <input type="checkbox" name="store[]" value="Organic Foods" id="c6">
      <label for="c6">Organic Foods</label>
    </div>

    <div class="one-fourth">
      <input type="checkbox" name="store[]" value="Kiosk in Mall" id="c7">
      <label for="c7">Kiosk in Mall</label><br>
      <input type="checkbox" name="store[]" value="Kiosk in Market" id="c8">
      <label for="c8">Kiosk in Market</label><br>
      <input type="checkbox" name="store[]" value="Lunch Counter" id="c9">
      <label for="c9">Lunch Counter</label>
    </div>

    <div class="one-fourth last">
      <input type="checkbox" name="store[]" value="Other" id="c10">
      <label for="c10">Other</label>
    </div>

    <div style="clear: both;"></div>

    <input type="hidden" name="referrer" value="become-a-retailer.php">

    <input type="text" name="confirmationCAP" style="display: none;">

    <input type="hidden" name="ip" value="<?php echo $ip; ?>">
    <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

    <div id="retailer-form-messages"><?php echo $feedback; ?></div>

    <input type="submit" name="submit" value="SUBMIT">
  </div>
</form>

<?php include "footer.php"; ?>