<?php
include_once "includes/db_controller.php";
include_once "includes/helpers.php";

if (!empty($_POST)) {
	if (isset($_POST["update"])) {
    	update_row($db);
  	} else if (isset($_POST["delete"])) {
    	delete_row($db);
  	} else {
    	insert_into_db($db);
  	}
}

?>

<!DOCTYPE html>

<html lang="en-US">
  
  <?php include 'includes/html/page_head.html' ?>
  
  <body>

  <?php include 'includes/html/header.html' ?>
    
    
    <div id="insert_photos" class="entry_field">
      <h2>Add Photo</h2>
      <form action="" method="post" name="photos">
        <label for="tables[photos][photo_id]">Photo Title:</label>
          <input name="tables[photos][photo_id]" id="tables[photos][photo_id]" type="text"/><br />
        <label for="tables[photos][description]">Photo Description:</label>
          <input name="tables[photos][description]" id="tables[photos][description]" type="textarea"/><br />
        <label for="tables[photos][native_height_px]">Height(px):</label>
          <input name="tables[photos][native_height_px]" id="tables[photos][native_height_px]" type="text"/><br />
        <label for="tables[photos][native_width_px]">Width(px):</label>
          <input name="tables[photos][native_width_px]" id="tables[photos][native_width_px]" type="text"/><br />
      
        <input type="submit" value="Add Photo"/>    
      </form>
    </div>
    
    
    <div id="insert_galleries" class="entry_field">
      <h2>Add Gallery</h2>
      <form action="" method="post" name="galleries">
        <label for="tables[galleries][name]">Name:</label>
          <input type="text" name="tables[galleries][name]" id="tables[galleries][name]"/><br />
        <label for="tables[galleries][address]">Address:</label>
          <input type="text" name="tables[galleries][address]" id="tables[galleries][address]"/><br />
        <label for="tables[galleries][contact_person]">Contact Person:</label>
          <input type="text" name="tables[galleries][contact_person]" id="tables[galleries][contact_person]"/><br />
        <label for="tables[galleries][landline]">Landline:</label>
          <input type="text" name="tables[galleries][landline]" id="tables[galleries][landline]"/><br />
        <label for="tables[galleries][cellphone]">Cellphone:</label>
          <input type="text" name="tables[galleries][cellphone]" id="tables[galleries][cellphone]"/><br />
      
      <input type="submit" value="Add Gallery"/>
      </form>
    </div>
    
    
    
    <div id="insert_products" class="entry_field">
      <h2>Add Product Type</h2>
      <form action="" method="post" name="products">
        <label for="tables[products][product_id]">Product name:</label>
          <input type="text" name="tables[products][product_id]" id="tables[products][product_id]"/><br />
        <label for="tables[products][print_type]">Type of Print:</label>
          <input type="text" name="tables[products][print_type]" id="tables[products][print_type]"/><br />
        <label for="tables[products][description]">Description:</label>
          <input type="text" name="tables[products][description]" id="tables[products][description]"/><br />
        <label for="tables[products][print_cost]">Print cost:</label>
          <input type="text" name="tables[products][print_cost]" id="tables[products][print_cost]"/><br />
        <label for="tables[products][retail_price]"> Retail Price:</label>
          <input type="text" name="tables[products][retail_price]" id="tables[products][retail_price]"/><br />
          
        <input type="submit" value="Add Product Type">
      </form>
    </div>
    
    <div id="insert_shops" class="entry_field">
      <h2>Add Print Shop</h2>
      <form action="" method="post" name="products">
        <label for="tables[shops][shop_name]">Shop Name:</label>
          <input name="tables[shops][shop_name]" id="tables[shops][shop_name]" type="text"/><br />
        <label for="tables[shops][location]">Location:</label>
          <input name="tables[shops][location]" id="tables[shops][location]" type="text"/><br />
        <label for="tables[shops][shop_telephone]">Shop Telephone:</label>
          <input name="tables[shops][shop_telephone]" id="tables[shops][shop_telephone]" type="text"/><br />
          
        <input type="submit" value="Add Printing Shop"/>
      </form>
    </div>    
    
    
    <div id="insert_prints" class="entry_field">
      <h2>Add Prints to Database</h2>
      <form method="post" action="" name="prints">
       
        <select name="tables[prints][photo_id]">
          <?php $results = select_photo_with_id($db, "photo_id"); ?>
          <?php foreach ($results as $result): ?>
            <option value="<?php echo $result ?>">
              <?php echo $result ?>
            </option>
          <?php endforeach ?>
        </select>

        <?php $prints_exist = check_if_entries($results) ?>
       
        <select name="tables[prints][product_id]">
          <?php $results = select_product_with_id($db, "product_id"); ?>
          <?php foreach ($results as $result): ?>
            <option value="<?php echo $result ?>">
              <?php echo $result ?>
            </option>
          <?php endforeach ?>
        </select>
        
        <select name="options[repeats]">
          <?php for ($i=1; $i<=15; $i+=1) {echo "<option value='$i'>$i</option>";} ?>
        </select>

        <?php $products_exist = check_if_entries($results) ?>


        <?php $check_disabled_args = [$prints_exist, $products_exist] ?>


        <input type="submit" value="Add to database" <?php echo check_disabled($check_disabled_args) ?>/>
      </form>
  </div>
  
  <?php include 'includes/html/footer.html' ?>

  </body>
</html>