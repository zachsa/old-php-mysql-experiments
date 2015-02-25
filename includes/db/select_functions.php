<?php
function select_photos($db, $tbl)
{
	$sql = "SELECT * FROM $tbl;";
	$result = query($db, $sql);
	$rows = get_rows($db, $result);
	return $rows;
}



function select_join_PrintsGalleriesStock($db)
{
	$sql = 
    "SELECT
      prints.print_id,
      prints.photo_id,
      prints.assigned,
      galleries.gallery_id,
      galleries.name,
      prints.product_id
    FROM prints
    LEFT JOIN stock_details
      ON prints.print_id = stock_details.print_id
    LEFT JOIN galleries
      ON stock_details.gallery_id = galleries.gallery_id;";    
	$result = query($db, $sql);
	$rows = get_rows($db, $result);

	return $rows;
}



function select_assigned_prints($db) 
{
	$sql = "SELECT * FROM prints WHERE assigned = FALSE;";
	$result = query($db, $sql);
	$rows = get_rows_with_field($db, $result, "photo_id");
	$check = check_row_count($rows);
	return $check; 
}



function select_gallery_names($db)
{
	$sql = "SELECT * FROM galleries;";
	$result = query($db, $sql);
	$rows = get_rows_with_field($db, $result, "name");
	$check = check_row_count($rows);
	return $check; 
}



function select_photo_with_id($db)
{
  $sql = "SELECT * FROM photos;";
	$result = query($db, $sql);
	$rows = get_rows_with_field($db, $result, "photo_id");
	$check = check_row_count($rows);
	return $check; 
}



function select_product_with_id($db) 
{
	$sql = "SELECT * FROM products;";
	$result = query($db, $sql);
	$rows = get_rows_with_field($db, $result, "product_id");
	$check = check_row_count($rows);
	return $check;  
}



function select_stock($db)
{
	$sql = 
	"SELECT * FROM stock_details 
	 INNER JOIN galleries 
    on stock_details.gallery_id = galleries.gallery_id 
	 INNER JOIN prints
    on stock_details.print_id = prints.print_id
    WHERE assigned = TRUE;";
	$result = query($db, $sql);
	$rows = get_rows($db, $result);
	return $rows;
}




function swap_field_val($db, $correct_field_name, $other_field_val, $check_stock = false)
{
  	$table = $_POST['options']['field_swap'][$correct_field_name][0];
  	$other_field = $_POST['options']['field_swap'][$correct_field_name][1];
  	$sql = "SELECT $correct_field_name FROM $table WHERE $other_field = '$other_field_val'";
  
  	if ($check_stock) {
  		if ($table == "prints") {
  			$sql .= " AND assigned = FALSE";
    	}
  	}
  
  	$sql .= " ORDER BY $correct_field_name LIMIT 1;";

  	$result = query($db, $sql);
  	$content = get_rows($db, $result);

  	return $content[0][$correct_field_name];
}


?>