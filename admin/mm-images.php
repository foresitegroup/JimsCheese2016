<div class="mm-image-header">Click image to select</div>

<?php
$files = glob("../images/products/*.{jpg,gif,png}", GLOB_BRACE);

usort($files, function($a, $b) {
  return filemtime($a) < filemtime($b);
});

foreach ($files as $filepath) {
  $file = basename($filepath); 
  echo "<div class=\"mm-image select-image\" style=\"background-image: url(" . $filepath . "); \"title=\"" . $file . "\"><div class=\"mm-image-text\">" . $file . "</div></div>\n";
}
?>