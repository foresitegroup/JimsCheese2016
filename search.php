<?php
$PageTitle = ($_POST['search'] != "") ? "Search Results for \"" . $_POST['search'] . "\"" : "Search";
$PlaceHolder = ($_POST['search'] != "") ? "SEARCH AGAIN" : "SEARCH";
?>
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
  
  <div class="site-width" style="padding: 5em 0;">
    <?php
    if ($_POST['search'] != "") {
      $dir = opendir(".");
      while (false != ($file = readdir($dir))) {
        if ((substr(strrchr($file, "."), 1) == "php") && ($file != "header.php") && ($file != "footer.php") && ($file != "menu.php") && ($file != "search.php")) {
          $files[] = $file;
        }
      }
      closedir($dir);
      natcasesort($files);
      
      foreach ($files as $file) {
        $contents = file_get_contents($file);
        
        if (preg_match("/" . $_POST['search'] . "/i", $contents, $oresult)) {
          // Found something.  Flip the "no results" switch.
          $sresults = "yes";
          
          // Extract the page title
          preg_match("/PageTitle = \"(.*?)\"/", $contents, $matches);
          
          // Set variable to display page title or file name if no title
          $stitle = ($matches[1] != "") ? $matches[1] : $file;
          $stitle = ($stitle == "index.php") ? "Home" : $stitle;
          
          // Display the results
          $TheResults .= "<a href=\"$file\">$stitle</a><br>\n";
          
          // Get position of search term to create a result snippet
          $pos = stripos(trim(strip_tags($contents)), $_POST['search']);
          $start = ($pos-20 < 0) ? 0 : $pos-20;
          
          // Build the snippet
          if ($start > 0) $TheResults .= "...";
          $snippet = substr(trim(strip_tags($contents)), $start, 140) . "...<br><br>\n";
          
          // Bold the search term in the snippet and display it
          $TheResults .= preg_replace("/" . $_POST['search'] . "/i", "<strong>" . $oresult[0] . "</strong>", $snippet);
        }
      }
      
      echo "<div style=\"font-weight: bold;\">\n";
        // If nothing is found, man up and apologize.
        if ($sresults != "yes") {
          echo "Sorry, no results for \"" . $_POST['search'] . "\".\n";
        } else {
          echo $PageTitle . "<br>\n";
        }
      echo "</div><br>\n";

      if ($sresults == "yes") echo $TheResults . "<br>\n";
    }
    ?>

    <form class="searchpage" method="POST" action="search.php">
      <div>
        <input type="text" name="search" placeholder="<?php echo $PlaceHolder; ?>">
      </div>
    </form>
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