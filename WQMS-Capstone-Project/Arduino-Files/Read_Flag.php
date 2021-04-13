<!--
Arduino checking the flag as to which data needs to be measured.
-->

<?php

	include('Database_Connection.php');

	$sql="SELECT * FROM measure_flags";

	$records=mysqli_query($conn,$sql);
	$json_array=array();
	
	while($row=mysqli_fetch_assoc($records))
	{
		$json_array=$row;
		
	}
	echo json_encode($json_array["Value"], JSON_NUMERIC_CHECK);
?>