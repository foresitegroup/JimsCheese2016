<?php
$GLOBALS['MonthlySpecials'] = "May_2017_Specials";
$GLOBALS['MonthlySpecialsTitle'] = "May 2017 Specials";

if (!isset($TopDir)) $TopDir = "";

function email($address, $name="") {
  $email = "";
  for ($i = 0; $i < strlen($address); $i++) { $email .= (rand(0, 1) == 0) ? "&#" . ord(substr($address, $i)) . ";" : substr($address, $i, 1); }
  if ($name == "") $name = $email;
  echo "<a href=\"&#109;&#97;&#105;&#108;&#116;&#111;&#58;$email\">$name</a>";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Jim's Cheese<?php if (isset($PageTitle)) echo " | " . $PageTitle; ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $TopDir; ?>images/favicon.ico">
    <link rel="apple-touch-icon" href="<?php echo $TopDir; ?>images/apple-touch-icon.png">

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="designer" content="Foresite Group">
    <meta name="author" content="Jim's Cheese">

    <meta name="viewport" content="width=device-width">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800|Roboto+Slab:700|Work+Sans:600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $TopDir; ?>inc/main.css?<?php if ($TopDir == "") echo filemtime('inc/main.css'); ?>">

    <script type="text/javascript" src="<?php echo $TopDir; ?>inc/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="<?php echo $TopDir; ?>inc/jquery.waypoints.min.js"></script>
    <script type="text/javascript" src="<?php echo $TopDir; ?>inc/jquery.modal.min.js"></script>
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

    <!-- BEGIN Google Analytics -->
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-33501604-1']);
      _gaq.push(['_trackPageview']);
      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script>
    <!-- END Google Analytics -->
  </head>
  <body>

  <div id="search" style="display: none;">
    <form class="site-width" method="POST" action="<?php echo $TopDir; ?>search.php">
      <div>
        <input type="text" name="search" placeholder="SEARCH...">
      </div>
    </form>
  </div>

  <div class="jc-header">
    <a href="<?php echo $TopDir; ?>." id="logo"><img src="<?php echo $TopDir; ?>images/logo.png" alt=""></a>

    <div class="top-menu">
      <div class="site-width">
        <a href="<?php echo $TopDir; ?>contact.php">Contact</a>
        <a href="<?php echo $TopDir; ?>pdf/Jim's_Cheese_Product_Guide.pdf">Product Guide</a>
        <a href="<?php echo $TopDir; ?>pdf/resellers/<?php echo $GLOBALS['MonthlySpecials']; ?>.pdf">Monthly Specials</a>
        <a href="<?php echo $TopDir; ?>resellers.php">Customer Login <i class="fa fa-user" aria-hidden="true"></i></a>
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
        <a href="." id="logo-scrolling"><img src="<?php echo $TopDir; ?>images/logo-scrolling.png" alt=""></a>
        <input type="checkbox" id="show-menu" role="button">
        <label for="show-menu" id="menu-toggle"></label>
        <div><?php include "menu.php" ?></div>
      </div>
    </div>
  </div>
