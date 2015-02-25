<?php
function follow_up_insertion($db, $follow_ups)
{
	if (isset($follow_ups["assign_print"]))	{
    	$id = $follow_ups["assign_print"];
    	$sql = "UPDATE prints SET assigned = TRUE WHERE print_id = $id;";
  	}
  
  	$result = query($db, $sql);
}
?>