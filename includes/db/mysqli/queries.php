<?php


function query($db, $sql)
{
	if (!$result = $db->query($sql))
	{
		$output = "ERROR: ".$db->error;
		return $output;
	}

	return $result;
}




function get_rows($db, $result)
{
	$rows = [];
	while ($row = $result->fetch_assoc()) 
	{
		array_push($rows, $row);
	}

	return $rows;
}




function get_rows_with_field($db, $result, $field)
{
	$rows = [];
	while ($row = $result->fetch_assoc())
	{
      	array_push($rows, $row[$field]);
    }

    return $rows;
}




?>