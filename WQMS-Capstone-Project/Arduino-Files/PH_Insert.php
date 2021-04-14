<?php
/*
************************************************************************
*Title:             PH sensor data insert file to the database
*Author:            Chris Christie
*Code Version:      1.0
*Description:		This php file describes the get data function from
					the arduino sensor data to be inserted into the 
					qualities table in the web_monitor database
*************************************************************************
*/

//	Include the database connection file
include('Database_Connection.php');

//	Variable to obtain the ph value from arduino sensor 
//	using $_GET function
$pHValue=$_GET["pHValue"];

//	Inserting the value to the qualities table
$sql = "INSERT INTO qualities (Value)
VALUES ('".$pHValue."')";

//	Updating the measure flag with null for detecting any
//	other button click
$sql_temp = "UPDATE measure_flags SET Value='NULL' WHERE id=1";

//	Updating the data_inserts table to make sure the correct
//	value is inserted
$sql_details = "UPDATE data_inserts SET Value='PH Value Inserted' WHERE id=1";

//	If connection is established successfully update the echo command
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
  if ($conn->query($sql_temp) === TRUE) {
  	echo "updated measure flag with null";
  }

  if($conn->query($sql_details) === TRUE){
  	echo "updated data insert with text";
  }
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>