<?php
include_once "includes/db_controller.php";

if (!empty($_POST)) {
  if (isset($_POST["update"])) {
    delete_from_stock($db);
  } else if (isset($_POST["delete"])) {
    delete_row($db);
  } else {
    insert_into_db($db);
  }
}
?>




<html>
  	<head>
  	</head>
  	<body>
    	





    	<div id="show_photos">

      		<h2>Photos</h2>
       	
       		<?php $content = select_photos($db, "photos") ?>
       	
       		<?php if (!empty($content)): ?>
	       		<?php include("includes/partials/standard_table.html.php"); ?>
	       	<?php else: ?>
	       		<p><?php echo "No photos in database" ?></p>
	       	<? endif ?>
    	
    	</div>





    
    	<div id="show_galleries">
      		
      		<h2>Galleries</h2>
       		
       		<?php $content = select_photos($db, "galleries") ?>
       		
       		<?php if (!empty($content)): ?>
       	   		<?php include("includes/partials/standard_table.html.php"); ?>
	       	<?php else: ?>
	       		<p><?php echo "No photos in database" ?></p>
	       	<? endif ?>   
    	
    	</div>





    
    	<div id="show_products">
      		
      		<h2>Products</h2>
       		
       		<?php $content = select_photos($db, "products") ?>
       		
       		<?php if (!empty($content) > 0): ?>
       			<?php include("includes/partials/standard_table.html.php"); ?>
       		<?php else: ?>
	       		<p><?php echo "No photos in database" ?></p>
	       	<? endif ?>
    	
    	</div>



    


<!-- ############################ Begin Prints Table ############################ -->
    	

    	<div id="show_prints">
      		
      		<h2>Prints</h2>
      		
      		<?php $content = select_join_PrintsGalleriesStock($db) ?>
	    	
	    	<?php if (count($content) > 0): ?>	
    	 	
    	 	<table>
        		
        		<thead>
         			<tr>
            			<th>Photo ID</th>
				   	    <th>Gallery Name</th>
            			<th>Product Type</th>
            			<th>ID</th>
          		 	    <th></th>
    	      		</tr>
        		</thead>			
        		
        		<tbody>

               		<?php for ($i=0; $i<count($content); $i++): ?>
            		<form action="" name="prints_table<?php echo $i ?>" method="post">
       	    			<tr>
           	  				<td><?php echo $content[$i]["photo_id"] ?></td>
           	  				<td><?php echo $content[$i]["name"] ?></td>
           	  				<td><?php echo $content[$i]["product_id"] ?></td>
           	  				<td><?php echo $content[$i]["print_id"] ?></td>

           					<td>
           						<input type="hidden" id="<?php echo "delete[prints][$i]" ?>" name="<?php echo "delete[prints][$i]" ?>" value="<?php echo $content[$i]['print_id'] ?>"/>
          						<input type="submit" id="" value="Remove Print">
          					</td>

   	        			</tr>
          			</form>	
          			<?php endfor ?>
          		
        		</tbody>

      		</table>
      		
      		<?php else: ?>
      		<p><?php echo "No photos in database" ?></p>
     		<? endif ?>
    	
    	</div>
    	
<!-- ############################ End Prints Table ############################ -->


















<!-- ############################ Begin Stock Assign Form ############################ -->

    
    
    	<div id="insert_stock_detail">
      		<h2>Gallery Stock Assignment</h2>

      		<form method="post" action="" name="stock_details">
        		<?php $results = select_assigned_prints($db); ?>
        		<?php if ($results == false):?>
          			<input type="text" value="No Prints Available" disabled/>
        		<?php else: ?>
          			<select name="tables[stock_details][print_id]">        
            			<?php foreach ($results as $result): ?>
              				<option value="<?php echo $result ?>">
                				<?php echo $result ?>
              				</option>
            			<?php endforeach ?>
          			</select>	
        		<?php endif; ?>
        
        		<?php $results = select_gallery_names($db); ?>
        		<select name="tables[stock_details][gallery_id]">
          			<?php foreach ($results as $result): ?>
            			<option value="<?php echo $result ?>">
              				<?php echo $result ?>
            			</option>
          			<?php endforeach ?>
        		</select>
        

        		<input type="hidden" id="options[field_swap][gallery_id][0]" name="options[field_swap][gallery_id][0]" value="galleries"/>
        		<input type="hidden" id="options[field_swap][gallery_id][1]" name="options[field_swap][gallery_id][1]" value="name"/>
        
        		<input type="hidden" id="options[field_swap][print_id][0]" name="options[field_swap][print_id][0]" value="prints"/>
        		<input type="hidden" id="options[field_swap][print_id][0]" name="options[field_swap][print_id][1]" value="photo_id"/>
        
        		<input type="hidden" id="options[stock_update]" name="options[stock_update]" value="true"/>
        
        		<input type="submit" value="Assign Stock"/>
      		</form>
    	</div>
    
    
 <!-- ############################ End Stock Assign Form ############################ -->











 <!-- ############################ Begin Stock Table ############################ -->


    <div id="show_stock_info">
      	
      	<h2>Stock</h2>
      	
      	<?php $content = select_stock($db, "stock_details", ["galleries" => ["field" => "name", "join" => "gallery_id"], "prints" => ["field" => "photo_id", "join" => "print_id"]], true) ?>
      	<?php if (count($content) > 0): ?>
      	
      	<table>
        
        	<thead>
        		<tr>
            		<?php foreach($content[0] as $field_name=>$val):?>
              			<?php echo "<th>".$field_name."</th>"; ?>
            		<? endforeach ?>
            		<th></th>
          		</tr>
        	</thead>
        
        	
        	<tbody>
        		
        		<?php for ($i=0; $i<count($content); $i ++): ?>
        		<form method="post" name="stock_table[<?php echo $i ?>]" action="">
          			<tr>
            			<td><?php echo $content[$i]["gallery_id"] ?></td>
            			<td><?php echo $content[$i]["print_id"] ?></td>
            			<td><?php echo $content[$i]["quantity"] ?></td>
            			<td><?php echo $content[$i]["stock_id"] ?></td>
            			<td><?php echo $content[$i]["name"] ?></td>
            			<td><?php echo $content[$i]["address"] ?></td>
            			<td><?php echo $content[$i]["contact_person"] ?></td>
            			<td><?php echo $content[$i]["quantity"] ?></td>
            			<td><?php echo $content[$i]["landline"] ?></td>
            			<td><?php echo $content[$i]["cellphone"] ?></td>
            			<td><?php echo $content[$i]["photo_id"] ?></td>
            			<td><?php echo $content[$i]["product_id"] ?></td>
            			<td><?php echo $content[$i]["assigned"] ?></td>
            			
            			<td><input type="hidden" id="" name="<?php echo "update[prints][$i]" ?>" value="<?php echo $content[$i]['print_id'] ?>"/>
            			<input type="submit" id="" value="Remove From Gallery"></td>        
          			
          			</tr>

        		</form>
        		<? endfor ?>

        	</tbody>

      	</table>

    	<? else: ?>
    		<p><?php echo "No stock is assigned" ?></p>
    	<? endif ?>

    </div>


 <!-- ############################ End Stock Table ############################ -->



      
	</body>
</html>