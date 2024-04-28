<?php
// Database connection
include "db_connect.php";

// Generate random token
$token = substr(md5(uniqid(rand(), true)), 0, 6); // Adjust the length of the token as needed

// Get subject name from POST request
$subjectName = $_POST['subject_name'];

// Insert token and subject name into the database
$sql = "INSERT INTO tokens (token, subject_name) VALUES ('$token', '$subjectName')";
if ($conn->query($sql) === TRUE) {
    echo $token; // Return the generated token
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>