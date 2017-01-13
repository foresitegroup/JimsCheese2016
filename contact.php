<?php
session_start();

$PageTitle = "Contact";
include "header.php";
?>

<div class="banner overlay" style="background-image: url(images/retailer-banner.jpg);">
  <div class="site-width">
    <h1>CONTACT JIM'S CHEESE</h1>
    JIM'S CHEESE PROUDLY SINCE 1955
  </div>
</div>

<div class="address-banner">
  Jim's Cheese <span class="spacer">&bull;</span> 410 Portland Rd <span class="spacer">&bull;</span> Waterloo, WI 53594
</div>

<div class="site-width retailer-content contact-content">
  Jim's Cheese ready to serve you. Please contact us using the form below and a company representative will contact you or call us at:<br>
  <br>

  <div style="font-size: 20px; line-height: 1.4em;">
    <span class="yellowtext">Phone:</span> 920-478-3571 or 800-345-3571 <span class="spacer">//</span> <span class="yellowtext">Fax:</span> 920-478-2320
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var form = $('#contact-form');
    var formMessages = $('#form-messages');
    $(form).submit(function(event) {
      event.preventDefault();

      function formValidation() {
        if ($('#name').val() === '') { alert('Name required.'); $('#name').focus(); return false; }
        if ($('#email').val() === '') { alert('Email required.'); $('#email').focus(); return false; }
        if ($('#phone').val() === '') { alert('Phone required.'); $('#phone').focus(); return false; }
        if ($('[name="contact"]:checked').length === 0) { alert('Contact method required.'); return false; }
        if ($('#message').val() === '') { alert('Message required.'); $('#message').focus(); return false; }
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
$salt = "JimsCheeseContactForm";
?>

<noscript>
<?php
$feedback = (!empty($_SESSION['feedback'])) ? $_SESSION['feedback'] : "";
unset($_SESSION['feedback']);
?>
</noscript>

<form action="form-contact.php" method="POST" id="contact-form" class="dark-form">
  <div>
    <div class="required">All fields required</div>

    <input type="text" name="<?php echo md5("name" . $ip . $salt . $timestamp); ?>" id="name" placeholder="Name">

    <input type="email" name="<?php echo md5("email" . $ip . $salt . $timestamp); ?>" id="email" placeholder="Email">

    <input type="text" name="<?php echo md5("phone" . $ip . $salt . $timestamp); ?>" id="phone" placeholder="Phone">

    <div class="label">Message:</div>
    <textarea name="<?php echo md5("message" . $ip . $salt . $timestamp); ?>" id="message"></textarea>

    <div class="radio">
      <span>Best form of contact:</span>
      <input type="radio" name="contact" value="Phone" id="r-phone">
      <label for="r-phone">Phone</label>
      <input type="radio" name="contact" value="Email" id="r-email">
      <label for="r-email">Email</label>
    </div>

    <input type="hidden" name="referrer" value="contact.php">

    <input type="text" name="confirmationCAP" style="display: none;">

    <input type="hidden" name="ip" value="<?php echo $ip; ?>">
    <input type="hidden" name="timestamp" value="<?php echo $timestamp; ?>">

    <div id="form-messages"><?php echo $feedback; ?></div>

    <input type="submit" name="submit" value="SUBMIT">
  </div>
</form>

<?php include "footer.php"; ?>