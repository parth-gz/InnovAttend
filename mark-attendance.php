<?php
include "db_connect.php";

// Get the entered token and subject name from the form submission
$enteredToken = $_POST['token'];
$subjectName = $_POST['subject'];

// Check if the tokens table is empty
$sql = "SELECT * FROM tokens";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Token table is empty
    echo "<script>alert('Token Expired, report to your teacher'); window.location.href = 'student-home.php';</script>";
    exit();
}

// Validate the entered token and subject
$sql = "SELECT * FROM tokens WHERE token = '$enteredToken'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Token and subject match
    echo "<script>alert('Attendance marked successfully'); window.location.href = 'student-home.php';</script>";
} else {
    // Invalid token or subject
    echo "<script>alert('Invalid token entered'); history.back();</script>";
}

$conn->close();
?>
