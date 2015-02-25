<?php
function delete_row($db)
{
	foreach ($_POST['delete'] as $table=>$i)
	{
        foreach ($i as $key => $field)
        {
            $sql = "DELETE FROM $table WHERE print_id = '$field';";
            $result = query($db, $sql);
        }
    } 
}



function delete_from_stock($db)
{
 	foreach ($_POST['update'] as $table=>$i)
 	{
		foreach ($i as $key=>$field)
		{
    		$sql = "UPDATE $table SET assigned = FALSE WHERE print_id = '$field'";
    		$result = query($db, $sql);
    		$sql = "DELETE FROM stock_details WHERE print_id = '$field'";
    		$result = query($db, $sql);
    	}
  	}
}


?>