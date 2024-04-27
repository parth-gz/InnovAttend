<?php
// Database connection parameters
$servername = "localhost"; // Change this if your database server is hosted elsewhere
$username = "root"; // Change this to your database username
$password = "mysql_password"; // Change this to your database password
$dbname = "InnovAttend"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
