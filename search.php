<?php
$PageTitle = ($_POST['search'] != "") ? "Search Results for \"" . $_POST['search'] . "\"" : "Search";
$PlaceHolder = ($_POST['search'] != "") ? "SEARCH AGAIN" : "SEARCH";

include "header.php";
?>

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

<?php include "footer.php"; ?>