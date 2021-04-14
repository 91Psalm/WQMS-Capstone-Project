<?php
/*
************************************************************************
*Title:             Insert the temperature data from the arduino to
					the database
*Author:            Chris Christie
*Code Version:      1.0
*Description:		This php file describes the insertion of temperature
					data into the database from the temperature sensor 
					connected to the arduino
*************************************************************************
*/

//	Include the database connection file
include('Database_Connection.php');

//	Variables to get the temperature values from the arduino
$tempC=$_GET["temp_C"];
$tempF=$_GET["temp_F"];

//	Insert the above values into the temperature table
$sql = "INSERT INTO temperatures (Celcius, Fahrenheit)
VALUES ('".$tempC."','".$tempF."')";

//	Update the measure flag table after the temperature value insert
$sql_temp = "UPDATE measure_flags SET Value='NULL' WHERE id=1";

//	Once the temperature value is inserted, update the data insert table
//	to confirm that the data is inserted
$sql_details = "UPDATE data_inserts SET Value='Temperature Values Inserted' WHERE id=1";

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