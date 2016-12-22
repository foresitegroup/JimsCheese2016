<?php
if (!isset($_POST['submit']) && $_SERVER['QUERY_STRING'] == "thankyou") header("Location: where-to-buy.php");

include_once "inc/dbconfig.php";

$wtb = "no";

$PageTitle = "Where To Buy";

include "header.php";
?>

<!-- BEGIN Google Conversion -->
<script type="text/javascript">
  /* <![CDATA[ */
  var google_conversion_id = 1008631094;
  var google_conversion_language = "en";
  var google_conversion_format = "2";
  var google_conversion_color = "ffffff";
  var google_conversion_label = "5exrCPLk4wMQtvr54AM";
  var google_conversion_value = 0;
  /* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js"></script>
<noscript>
  <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1008631094/?value=0&amp;label=5exrCPLk4wMQtvr54AM&amp;guid=ON&amp;script=0"/>
  </div>
</noscript>
<!-- END Google Conversion -->

<div class="banner" style="background-image: url(images/where-to-buy-banner.jpg);">
  <div class="site-width">
    <h1>WHERE TO BUY</h1>
    ENTER YOUR ZIP CODE TO LOCATE A JIM'S CHEESE RETAILER NEAR YOU!
  </div>
</div>

<div class="footer-where wtb">
  <div class="site-width">
    <form action="where-to-buy.php?thankyou" method="post">
      <div>
        <span>FIND A LOCATION:</span>

        <input type="text" name="zip" placeholder="ENTER ZIP CODE" value="<?php if (isset($_POST['distance'])) echo $_POST['zip']; ?>">

        <div class="select">
          <select name="distance">
            <option value="5"<?php if (isset($_POST['distance']) && $_POST['distance'] == "5") echo " selected"; ?>>5 MILES</option>
            <option value="10"<?php if (isset($_POST['distance']) && $_POST['distance'] == "10") echo " selected"; ?>>10 MILES</option>
            <option value="25"<?php if (isset($_POST['distance']) && $_POST['distance'] == "25") echo " selected"; ?>>25 MILES</option>
            <option value="50"<?php if (isset($_POST['distance']) && $_POST['distance'] == "50") echo " selected"; ?>>50 MILES</option>
            <option value="100"<?php if (isset($_POST['distance']) && $_POST['distance'] == "100") echo " selected"; ?>>100 MILES</option>
          </select>
        </div>

        <input type="submit" name="submit" value="FIND RETAILER">
      </div>
    </form>
  </div>
</div>

<?php if (isset($_POST['submit'])) { ?>
<link rel="stylesheet" href="inc/jquery.mCustomScrollbar.css" />
<script src="inc/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    if($(window).width() <= 600){
      $('.where-to-buy-left').removeClass('mCustomScrollbar');
    }
  });
</script>

<div class="where-to-buy cf">
  <div id="map-canvas"></div>

  <div class="where-to-buy-left mCustomScrollbar" data-mcs-theme="dark-thick">
    <h2>Locations within <?php echo $_POST['distance']; ?> miles of <?php echo $_POST['zip']; ?></h2>

    <?php
    // Get lat/lon of inputted zip code
    $json = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . $_POST['zip']);
    $json = json_decode($json);

    $MyLat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
    $MyLon = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
    
    // Search DB for any records within range of zip code
    $result = $mysqli->query("SELECT *, ( 3959 * acos( cos( radians($MyLat) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians($MyLon) ) + sin( radians($MyLat) ) * sin( radians( latitude ) ) ) ) AS distance FROM where_to_buy HAVING distance < " . $_POST['distance'] . " ORDER BY distance;");

    $Markers = "";

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      // Sanitize the address for geocoding
      $searchaddress = trim($row['address']) . " " . trim($row['city']) . " " . trim($row['state']) . " " . trim($row['zip']);
      $searchaddress = urlencode($searchaddress);
      
      // Format location/infobox data
      $info = "<h3>" . stripslashes($row['customer']) . "</h3>";
      $info .= stripslashes(ucwords(strtolower($row['address']))) . "<br>";
      $info .= stripslashes(ucwords(strtolower($row['city']))) . ", " . $row['state'] . " " . $row['zip'] . "<br>";

      if (!empty($row['telephone'])) $info .= $row['telephone'] . "<br>";

      $distplural = (round($row['distance']) > 1) ? "S" : "";

      $info .= "<div class='directions'>ABOUT " . round($row['distance']) . " MILE" . $distplural . " <a href='http://maps.google.com/maps?daddr=" . $searchaddress . "'>GET DIRECTIONS</a></div>";

      // Create map markers and infobox
      $Markers .= "[\"" . $info . "\", " . $row['latitude'] . ", " . $row['longitude'] . "],";
      
      // Display locations in sidebar
      echo "<div class=\"location\">\n" . $info . "\n</div>\n";
    }

    // Trim end comma
    $Markers = substr($Markers, 0, -1);

    // No dealers were found
    if ($Markers == "") echo "No locations found.  Try expanding the distance and searching again.";
    ?>
  </div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsYHlhPNJrhIiwvbdMa9w5xcjE3iAAJ2A"></script>
  <script>
    function initialize() {
      var MyLatLng = new google.maps.LatLng(<?php echo $MyLat . ", " . $MyLon; ?>);
      var mapCanvas = document.getElementById('map-canvas');
      var mapOptions = {
        center: new google.maps.LatLng(<?php echo $MyLat . ", " . $MyLon; ?>),
        zoom: 13,
        disableDefaultUI: true,
        scrollwheel: false,
        zoomControl: true,
        zoomControlOptions: {
          style: google.maps.ZoomControlStyle.SMALL,
          position: google.maps.ControlPosition.RIGHT_BOTTOM
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP
      }

      var map = new google.maps.Map(mapCanvas, mapOptions)
      map.set('styles', [
        {
          "elementType": "geometry",
          "stylers": [{"color": "#ebe3cd"} ]
        },
        {
          "elementType": "labels.text.fill",
          "stylers": [{"color": "#523735"} ]
        },
        {
          "elementType": "labels.text.stroke",
          "stylers": [{"color": "#f5f1e6"} ]
        },
        {
          "featureType": "administrative",
          "elementType": "geometry.stroke",
          "stylers": [{"color": "#c9b2a6"} ]
        },
        {
          "featureType": "administrative.land_parcel",
          "elementType": "geometry.stroke",
          "stylers": [{"color": "#dcd2be"} ]
        },
        {
          "featureType": "administrative.land_parcel",
          "elementType": "labels.text.fill",
          "stylers": [{"color": "#ae9e90"} ]
        },
        {
          "featureType": "landscape.natural",
          "elementType": "geometry",
          "stylers": [{"color": "#dfd2ae"} ]
        },
        {
          "featureType": "poi",
          "elementType": "geometry",
          "stylers": [{"color": "#dfd2ae"} ]
        },
        {
          "featureType": "poi",
          "elementType": "labels.text.fill",
          "stylers": [{"color": "#93817c"} ]
        },
        {
          "featureType": "poi.park",
          "elementType": "geometry.fill",
          "stylers": [{"color": "#a5b076"} ]
        },
        {
          "featureType": "poi.park",
          "elementType": "labels.text.fill",
          "stylers": [{"color": "#447530"} ]
        },
        {
          "featureType": "road",
          "elementType": "geometry",
          "stylers": [{"color": "#f5f1e6"} ]
        },
        {
          "featureType": "road.arterial",
          "elementType": "geometry",
          "stylers": [{"color": "#fdfcf8"} ]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry",
          "stylers": [{"color": "#f8c967"} ]
        },
        {
          "featureType": "road.highway",
          "elementType": "geometry.stroke",
          "stylers": [{"color": "#e9bc62"} ]
        },
        {
          "featureType": "road.highway.controlled_access",
          "elementType": "geometry",
          "stylers": [{"color": "#e98d58"} ]
        },
        {
          "featureType": "road.highway.controlled_access",
          "elementType": "geometry.stroke",
          "stylers": [{"color": "#db8555"} ]
        },
        {
          "featureType": "road.local",
          "elementType": "labels.text.fill",
          "stylers": [{"color": "#806b63"} ]
        },
        {
          "featureType": "transit.line",
          "elementType": "geometry",
          "stylers": [{"color": "#dfd2ae"} ]
        },
        {
          "featureType": "transit.line",
          "elementType": "labels.text.fill",
          "stylers": [{"color": "#8f7d77"} ]
        },
        {
          "featureType": "transit.line",
          "elementType": "labels.text.stroke",
          "stylers": [{"color": "#ebe3cd"} ]
        },
        {
          "featureType": "transit.station",
          "elementType": "geometry",
          "stylers": [{"color": "#dfd2ae"} ]
        },
        {
          "featureType": "water",
          "elementType": "geometry.fill",
          "stylers": [{"color": "#b9d3c2"} ]
        },
        {
          "featureType": "water",
          "elementType": "labels.text.fill",
          "stylers": [{"color": "#92998d"} ]
        }
      ]);
      
      var locations = [
      <?php echo $Markers; ?>
      ];
      
      var infowindow = new google.maps.InfoWindow();
      var bounds = new google.maps.LatLngBounds();
      
      for (var i = 0; i < locations.length; i++) {
        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(locations[i][1], locations[i][2]),
          map: map,
          icon: "images/map-marker.png"
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));

        bounds.extend(marker.getPosition());
      };

      map.fitBounds(bounds);
    }

    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</div>
<?php } ?>


<?php include "footer.php"; ?>