<?php
include "login.php";

$PageTitle = "Products";
include "header.php";
?>

<div class="site-width admin">
  <div class="one-half">
    <h3>Add Product</h3><br>
    <form action="products-db.php?a=add" method="POST">
      <div>
        <input type="text" name="name" placeholder="Name">

        <input type="text" name="image" placeholder="Image" id="image">

        <textarea name="description" placeholder="Description"></textarea>
        
        <div class="select">
          <select name="category">
            <option value="">Category...</option>
            <?php
            $cresult = $mysqli->query("SELECT * FROM products_category ORDER BY name ASC");

            while($crow = $cresult->fetch_array(MYSQLI_ASSOC)) {
              echo "<option value=\"" . $crow['id'] . "\">" . $crow['name'] . "</option>\n";
            }
            ?>
          </select>
        </div>

        <strong>Publish</strong>
        &nbsp;
        <input type="radio" name="publish" value="on" id="r-pub-y" checked> <label for="r-pub-y">Yes</label>
        &nbsp;
        <input type="radio" name="publish" value="off" id="r-pub-n"> <label for="r-pub-n">No</label><br>
        <br>
        <br>

        <input type="submit" name="submit" value="SUBMIT" id="submit">

        <div style="clear: both;"></div>
      </div>
    </form>
  </div>
  
  <div class="one-half last">
    <?php
    if ($_SERVER['QUERY_STRING'] == "") {
      $ProductsTitle = "Products";

      $query = "SELECT products_category.name AS PCname, products.name AS name, products.id AS id, products.publish FROM products LEFT JOIN products_category ON products.category=products_category.id ORDER BY products_category.name, products.name ASC";
    } else {
      $cresult = $mysqli->query("SELECT * FROM products_category WHERE id = " . $_SERVER['QUERY_STRING']);
      $crow = $cresult->fetch_array(MYSQLI_ASSOC);
      $ProductsTitle =  $crow['name'] . " Products";

      $query = "SELECT * FROM products WHERE category = " . $_SERVER['QUERY_STRING'] . " ORDER BY name ASC";
    }
    ?>
    <h3><?php echo $ProductsTitle; ?></h3><br>

    <?php
    $result = $mysqli->query($query);

    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      echo "<div class=\"controls\">\n";
        echo "<a href=\"products-edit.php?id=" . $row['id'] . "\" title=\"Edit\" class=\"c-edit\"><i class=\"fa fa-pencil\"></i></a>\n";
        echo "<a href=\"products-db.php?a=delete&id=" . $row['id'] . "\" onClick=\"return(confirm('Are you sure you want to delete this record?'));\" title=\"Delete\" class=\"c-delete\"><i class=\"fa fa-trash\"></i></a>\n";
        echo "<a href=\"#\" class=\"pub\" id=\"" . $row['id'] . "\" title=\"" . $row['publish'] . "\"><i class=\"fa fa-toggle-" . $row['publish'] . "\"></i></a>\n";
      echo "</div>\n";
      
      echo "<div class=\"record cf\">\n";

        echo $row['name'];

        if ($_SERVER['QUERY_STRING'] == "") {
          $catname = ($row['PCname'] != "") ? $row['PCname'] : "<span style=\"font-weight: bold; color: #B7262F\";>none</span>";
          echo "<br><span class=\"small\">Category: " . $catname . "</span>\n";
        }

      echo "</div>\n";
    }

    $result->close();
    ?>
  </div>

  <div style="clear: both;"></div>
</div>


<script type="text/javascript">
  $(document).on("click", ".select-image", function() {
    event.preventDefault();
    $("#image").val(this.title);
    $("#image").css("background-image", 'url(../images/products/'+this.title+')');
    $("#mediamanager").dialog("close");
  });
</script>

<div id="mediamanager" title="Media Manager">
  <div id="tabs">
    <ul>
      <li><a href="mm-images.php">Select Image</a></li>
      <li><a href="mm-upload.php">Upload Image</a></li>
    </ul>
  </div>
</div>

<?php include "footer.php"; ?>