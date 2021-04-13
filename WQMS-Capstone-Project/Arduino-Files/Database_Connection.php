<!--
Establishing the database connection
-->

<?php
$servername = "localhost";
//$servername = "192.168.43.238";
$username = "Chris";
$password = "11235835231";
$dbname = "web_monitor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>