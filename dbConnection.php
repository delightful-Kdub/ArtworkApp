<?php
//connect to the server
$servername = "localhost";
$username = "root";
$password = "root";
$dbname= "IDD-632";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully<br>";

?>
