<?php

//Generic INSERT function for all INSERT querries
function insert_into_db($db)
{
	//For multiple insertions when using a "quantity" select
	if (isset($_POST['options']['repeats'])) {
		$counter = $_POST['options']['repeats'];
	} else {
		$counter = 1;
	}

	//Will repeat the insert query $counter number of times
	for ($z=0; $z<$counter; $z++)
	{

  		//Still needs to be sanitized
  		foreach (array_keys($_POST['tables']) as $table)
  		{

      		//Sets basic SQL
    		$sql = "INSERT INTO $table SET ";

	    	//A bit of a hack to assign prints when they are assigned to galleries
    		$follow_ups = array("assign_print" => false);
    	
      		//Cycles through the coloums of a table
    		foreach (array_keys($_POST['tables'][$table]) as $field)
    		{
    			//For the select boxes that display a name, but have to insert using an ID - swaps the fields...
    			if (isset($_POST['options']['field_swap'])) {

    				//To specific, but works for now. the problem is that some primary keys are numeric, some aren't.
        			if (isset($_POST['options']['stock_update']) && $field == 'print_id') {

        				//Function is located in select_functions.php
          				$new_var =  swap_field_val($db, $field, $_POST['tables'][$table][$field], true);
          				$follow_ups["assign_print"] = swap_field_val($db, $field, $_POST['tables'][$table][$field], true);

        			} else {

        				//For cases where the primary key is opposite to the other case (not integer maybe)
		        		$new_var =  swap_field_val($db, $field, $_POST['tables'][$table][$field]);
        			}

	        		$sql .= "$field = '$new_var',";
	        		
    	  		} else {

      				//For if no field swap needs to happen
        			$sql .= $field." = '".$_POST['tables'][$table][$field]."',";
      			}
    		}
    
   		 	$sql = rtrim($sql,',');
    		$sql .= ";";
  		}

	  	//Makes the query
  		$result = query($db, $sql);

	  	//Located in update_functions.php
  		follow_up_insertion($db, $follow_ups);
  	}
}
  
?>