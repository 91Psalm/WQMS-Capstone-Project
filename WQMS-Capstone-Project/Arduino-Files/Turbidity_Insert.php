<?php
<?php
/*
************************************************************************
*Title:             Insert the turbidity data from the arduino to
					the database
*Author:            Chris Christie
*Code Version:      1.0
*Description:		This php file describes the insertion of turbidity
					data into the database from the turbidity sensor 
					connected to the arduino
*************************************************************************
*/

//	Include the database connection file
include('Database_Connection.php');

//	Capture the turbidity value from arduino to the database
$turbV=$_GET["turbV"];

//	Insert the value into the turbidities table
$sql = "INSERT INTO turbidities (Value)
VALUES ('".$turbV."')";

//	Update the measure flag table after the turbidity value insert
$sql_temp = "UPDATE measure_flags SET Value='NULL' WHERE id=1";

//	Once the turbidity value is inserted, update the data insert table
//	to confirm that the data is inserted
$sql_details = "UPDATE data_inserts SET Value='Turbidity Value Inserted' WHERE id=1";

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