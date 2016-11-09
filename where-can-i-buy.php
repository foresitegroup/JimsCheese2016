<?php
if (!isset($_POST['submit']) && $_SERVER['QUERY_STRING'] == "thankyou") header("Location: where-can-i-buy.php");
$PageTitle = "Where Can I Buy";
include_once "inc/dbconfig.php";
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
    <form action="where-can-i-buy.php?thankyou" method="post">
      <div>
        Zip Code: <input type="text" name="zip" size="10" value="<?php if (isset($_POST['zip'])) echo $_POST['zip']; ?>"> &nbsp;
        Distance:
        <select name="distance">
          <option value="5"<?php if (isset($_POST['distance']) && $_POST['distance'] == "5") echo " selected"; ?>>5 miles</option>
          <option value="10"<?php if (isset($_POST['distance']) && $_POST['distance'] == "10") echo " selected"; ?>>10 miles</option>
          <option value="25"<?php if (isset($_POST['distance']) && $_POST['distance'] == "25") echo " selected"; ?>>25 miles</option>
          <option value="50"<?php if (isset($_POST['distance']) && $_POST['distance'] == "50") echo " selected"; ?>>50 miles</option>
          <option value="100"<?php if (isset($_POST['distance']) && $_POST['distance'] == "100") echo " selected"; ?>>100 miles</option>
        </select> &nbsp;
        <input type="submit" name="submit" value="Find">
      </div>
    </form>

    <?php if (isset($_POST['submit'])) { ?>
    <br>
    <strong>Locations within <?php echo $_POST['distance']; ?> miles of <?php echo $_POST['zip']; ?></strong><br>
    <br>

    <div style="float: left; width: 300px;">
      <?php
      // Set variables
      $zipdb = "zip.txt";

      // Set search radius
      switch ($_POST['distance']) {
      case 100:
        $SearchRadius = "1.2";
        break;
      case 50:
        $SearchRadius = "0.7";
        break;
      case 25:
        $SearchRadius = "0.33";
        break;
      case 10:
        $SearchRadius = "0.15";
        break;
      case 5:
        $SearchRadius = "0.08";
        break;
      }

      // Open Zip Code database
      $file_handle = fopen($zipdb, "rb");

      // Get the latitude and longitude of supplied Zip Code
      while (!feof($file_handle) ) {
        $line_of_text = fgets($file_handle);
        $parts = explode(",", $line_of_text);
        if ($parts[0] == $_POST['zip']) {
          $MyLat = $parts[3];
          $MyLon = $parts[4];
        }
      }

      // Close Zip Code database
      fclose($file_handle);

      // Define the minimum and maximum latitude and longitude
      $MaxLat = $MyLat + $SearchRadius;
      $MinLat = $MyLat - $SearchRadius;
      $MaxLon = $MyLon + $SearchRadius;
      $MinLon = $MyLon - $SearchRadius;

      // Open Zip Code database
      $file_handle = fopen($zipdb, "rb");

      while (!feof($file_handle) ) {
        // Check latitude and logitude of each line
        $line_of_text = fgets($file_handle);
        $parts = explode(",", $line_of_text);
        $ZipLat = $parts[3];
        $ZipLon = $parts[4];

        // If latitude and logitude in is range...
        if (($parts[3] <= $MaxLat) && ($parts[3] >= $MinLat) && ($parts[4] <= $MaxLon) && ($parts[4] >= $MinLon)) {
          // Calculate the distance between points
          $theta = $ZipLon - $MyLon;
          $dist = sin(deg2rad($ZipLat)) * sin(deg2rad($MyLat)) +  cos(deg2rad($ZipLat)) * cos(deg2rad($MyLat)) * cos(deg2rad($theta));
          $dist = acos($dist);
          $dist = rad2deg($dist);
          $miles = $dist * 60 * 1.1515;
          $miles = round($miles);

          // Shove into array
          $ZipArray[] = "$miles|$parts[0]|$parts[3]|$parts[4]";
        }
      }

      // Close Zip Code database
      fclose($file_handle);

      // Sort the array
      sort($ZipArray, SORT_NUMERIC);

      function GenLoc($ziparr) {
        global $mysqli;
        $Markers = "";

        // Index and letter for map markers
        $letter = "A";
        $GMindex = 0;

        // Open array of zip codes in radius and find any retailers within
        while (list($key, $val) = each($ziparr)) {
          $vals = explode("|", $val);
          $MyMiles = $vals[0];
          $MyFinalZip = $vals[1];

          $result = $mysqli->query("SELECT * FROM where_can_i_buy WHERE zip LIKE '" . $MyFinalZip . "%'");

          // If there is a match format and display it
          while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            // Sanitize the address for geocoding
            $searchaddress = trim($row['address']) . " " . trim($row['city']) . " " . trim($row['state']) . " " . trim($row['zip']);
            $searchaddress = urlencode($searchaddress);
            
            // No latitude or longitude in database
            if ($row['latitude'] == "" || $row['longitude'] == "") {
              // Get latitude and longitude for this address to display on map
              $request  = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $searchaddress .  "&sensor=false";
              $response = file_get_contents($request);
              
              $data = json_decode($response);
              $Llat = $data->results[0]->geometry->location->lat;
              $Llng = $data->results[0]->geometry->location->lng;

              $mysqli->query("UPDATE where_can_i_buy SET latitude = '" . $Llat . "', longitude = '" . $Llng . "' WHERE id = '" . $row['id'] . "'");
            } else {
              $Llat = $row['latitude'];
              $Llng = $row['longitude'];
            }
            
            if ($Llng != "") {
              ?>
              <div style="float: left; width: 20px; font-weight: bold;"><img src="images/markers/yellow_Marker<?php if ($GMindex < 26) echo $letter; ?>.png"></div>
              <div style="margin-left: 25px; text-transform: uppercase;">
                <?php echo stripslashes($row['customer']); ?><br>
                <?php echo stripslashes($row['address']); ?><br>
                <?php echo stripslashes($row['city']); ?>, <?php echo $row['state']; ?> <?php echo $row['zip']; ?><br>
                <?php if (!empty($row['telephone'])) echo $row['telephone'] . "<br>"; ?>
                <span style="font-size: 80%;">
                  About <?php echo $MyMiles; ?> miles &nbsp; <a href="http://maps.google.com/maps?daddr=<?php echo $searchaddress; ?>">Get Directions</a>
                </span>
              </div>
              <div style="clear: both;"></div>
              <br>

              <?php
              // Generate address string for map info box
              $info = "<strong>" . stripslashes($row['customer']) . "</strong><br>";
              $info .= stripslashes($row['address']) . "<br>";
              $info .= stripslashes($row['city']) . ", " . $row['state'] . " " . $row['zip'] . "<br>";
              if (!empty($row['telephone'])) $info .= $row['telephone'] . "<br>";

              $info .= "<br><a href='http://maps.google.com/maps?daddr=" . $searchaddress . "'>Get Directions</a>";

              // Create map markers and info box
              $MyMarker = ($GMindex < 26) ? "images/markers/yellow_Marker" . $letter . ".png" : "images/markers/yellow_Marker.png";
              $Markers .= "[\"" . $info . "\", " . $Llat . ", " . $Llng . ", \"" . $MyMarker . "\"],";

              // Increase index and letter by one
              $GMindex++;
              $letter++;
            }
          }
        }

        reset($ziparr);
        
        $Markers = substr($Markers, 0, -1);
        return $Markers;
      }

      $Markers = GenLoc($ZipArray);

      $lines = explode("\n", $Markers);
      $num_lines = "var numlines = " . count($lines) . ";";

      // No dealers were found
      if ($Markers == "") echo "No locations found.  Try expanding the distance and searching again.";
      ?>
    </div>

    <div id="map">
      <div id="map_canvas" style="width: 550px; height: 550px"></div>
      <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyCsYHlhPNJrhIiwvbdMa9w5xcjE3iAAJ2A"></script>
      <script type="text/javascript">
        var locations = [
        <?php echo $Markers; ?>
        ];
        
        var map = new google.maps.Map(
          document.getElementById("map_canvas"), {
            center: new google.maps.LatLng(<?php echo $MyLat . ", " . $MyLon; ?>),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          }
        );
        
        var infowindow = new google.maps.InfoWindow();
        
        var shadow = new google.maps.MarkerImage("images/markers/marker-shadow.png",
            new google.maps.Size(51, 37),
            new google.maps.Point(0,0),
            new google.maps.Point(0, 37));

        var marker, i;

        for (i = 0; i < locations.length; i++) {  
          marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map,
            icon: locations[i][3],
            shadow: shadow
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
              infowindow.setContent(locations[i][0]);
              infowindow.open(map, marker);
            }
          })(marker, i));
        }
      </script>
    </div> <!-- END map -->
    <?php } ?>
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