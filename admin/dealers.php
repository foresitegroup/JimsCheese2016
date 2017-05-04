<?php
include "login.php";
$PageTitle = "Dealers";
include "header.php";
?>

<div class="site-width admin">
  <div class="one-half">
    <h3>Add New Dealer</h3>
    <form action="dealers-db.php?a=add" method="POST">
      <div>
        <input type="text" name="customer" placeholder="Dealer">

        <input type="text" name="address" placeholder="Address">

        <input type="text" name="city" placeholder="City">
      
        <div class="select" style="float: left;">
          <select name="state">
            <option value="">State</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
          </select>
        </div>
        
        <div style="float: right;">
          <input type="text" name="zip" placeholder="Zip Code">
        </div>
        
        <div style="clear: both;"></div>

        <input type="text" name="telephone" placeholder="Telephone">

        <input type="text" name="latitude" placeholder="Latitude">

        <input type="text" name="longitude" placeholder="Longitude">
        <input type="submit" value="Submit">
      </div>
    </form>
    
    <br><br><br>
    <a href="dealers-export.php" id="togglebutton">Export Dealers to Spreadsheet</a>
  </div>
  
  <div class="one-half last">
    <h3>Existing Dealers</h3>
    <?php
    $result = $mysqli->query("SELECT * FROM where_to_buy ORDER BY customer ASC");
    
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
    ?>
      <div class="controls controls2">
        <a href="dealers-edit.php?id=<?php echo $row['id']; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
        <a href="dealers-db.php?a=delete&id=<?php echo $row['id']; ?>" title="Delete" onClick="return(confirm('Are you sure you want to delete this dealer?'));"><i class="fa fa-trash"></i></a>
      </div>
      <div class="record">
        <?php echo stripslashes($row['customer']); ?><br>
        <?php echo stripslashes($row['address']); ?><br>
        <?php echo stripslashes($row['city']); ?>, <?php echo $row['state']; ?> <?php echo $row['zip']; ?><br>
        <?php echo $row['telephone']; ?><br>
        <?php echo $row['latitude'] . ", " . $row['longitude']; ?>
      </div>
    <?php } ?>
  </div>
</div>

<?php include "footer.php"; ?>