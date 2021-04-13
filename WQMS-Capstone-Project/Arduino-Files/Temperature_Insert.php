<!--
Establishing the database connection and inserting the temperature value after measurement
-->

<?php

include('Database_Connection.php');

$tempC=$_GET["temp_C"];
$tempF=$_GET["temp_F"];

$sql = "INSERT INTO temperatures (Celcius, Fahrenheit)
VALUES ('".$tempC."','".$tempF."')";

$sql_temp = "UPDATE measure_flags SET Value='NULL' WHERE id=1";

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