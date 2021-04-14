<?php

/*
************************************************************************
*Title:             Read the data from database to arduino to see which 
					value to be measured
*Author:            Chris Christie
*Code Version:      1.0
*Description:		This php file describes the read table function to 
					let the arduino know which data needs to be activated
					inorder for the sensor to start the measurement.
*************************************************************************
*/

//	Include the database connection file
include('Database_Connection.php');

//	Seelct the data from the measure flag file
$sql="SELECT * FROM measure_flags";

//	connect the records to the musql library
$records=mysqli_query($conn,$sql);
$json_array=array();

//	While iterating through each character, pass
//	the data to the arduino serial monitor to visualize
while($row=mysqli_fetch_assoc($records))
{
	$json_array=$row;
	
}
echo json_encode($json_array["Value"], JSON_NUMERIC_CHECK);
?>