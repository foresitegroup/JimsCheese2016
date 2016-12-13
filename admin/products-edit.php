<?php
include "login.php";

$PageTitle = "Edit Product";
include "header.php";

$result = $mysqli->query("SELECT * FROM products WHERE id = '" . $_GET['id'] . "'");
$row = $result->fetch_array(MYSQLI_ASSOC);
?>

<div class="site-width admin edit">
  <div class="one-half edit">
    <h3>Edit Product</h3><br>
    <form action="products-db.php?a=edit" method="POST">
      <div>
        <input type="text" name="name" placeholder="Name"<?php if ($row['name'] != "") echo "value=\"" . $row['name'] . "\""; ?>>

        <input type="text" name="image" placeholder="Image" id="image"<?php if ($row['image'] != "") echo "value=\"" . $row['image'] . "\" style=\"background-image: url(../images/products/" . $row['image'] . ");\""; ?>>

        <textarea name="description" placeholder="Description"><?php if ($row['description'] != "") echo $row['description']; ?></textarea>

        <div class="select">
          <select name="category">
            <option value="">Category...</option>
            <?php
            $cresult = $mysqli->query("SELECT * FROM products_category ORDER BY name ASC");

            while($crow = $cresult->fetch_array(MYSQLI_ASSOC)) {
              echo "<option value=\"" . $crow['id'] . "\"";
              if ($crow['id'] == $row['category']) echo " selected";
              echo ">" . $crow['name'] . "</option>\n";
            }
            ?>
          </select>
        </div>

        <strong>Publish</strong>
        &nbsp;
        <input type="radio" name="publish" value="on" id="r-pub-y"<?php if ($row['publish'] == "on") echo " checked"; ?>> <label for="r-pub-y">Yes</label>
        &nbsp;
        <input type="radio" name="publish" value="off" id="r-pub-n"<?php if ($row['publish'] == "off") echo " checked"; ?>> <label for="r-pub-n">No</label><br>
        <br>
        <br>

        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

        <input type="submit" name="submit" value="UPDATE"  style="display: block; margin: 0 auto;">

        <div style="clear: both;"></div>
      </div>
    </form>
  </div>
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