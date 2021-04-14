<?php

/*
	Establishing database connection
	by providing servername, username, 
	password and database name
*/

$servername = "localhost";
$username = "Chris";
$password = "11235835231";
$dbname = "web_monitor";

//	Establishing connection to the server
$conn = new mysqli($servername, $username, $password, $dbname);

//	If connection not established, show error
//	else display connection successful.
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>