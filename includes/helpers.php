<?php


function check_row_count($rows)
{
	if (count($rows) < 1) {
    	return false;
    } else
    {
    	return $rows;
  	} 
}


function check_if_entries($rows)
{

	if ($rows == False)
	
	{
		return False;
	}

	else
	
	{
		return True;

	}

}


function check_disabled($arr)
{
	$check = "";
	
	foreach ($arr as $v)
	
	{
		if ($v == False)
		
		{
			$check = "disabled";
		}
	}

	return $check;
}


?>