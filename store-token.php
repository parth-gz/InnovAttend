<?php
// Database connection
include "db_connect.php";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the token from the POST request
$token = $_POST['token'];

// Insert the token into the database
$sql = "INSERT INTO tokens (token) VALUES ('$token')";
if ($conn->query($sql) === TRUE) {
    echo "Token stored successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
