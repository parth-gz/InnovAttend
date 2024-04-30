<?php
// Start session
session_start();

// Include the database connection script
include "db_connect.php";

// Check if the student is logged in
if (!isset($_SESSION['roll_number'])) {
    // Redirect to the login page if not logged in
    header("Location: student-login.php");
    exit();
}

// Get the subject name from the query parameter
$subjectName = $_GET['subject'];

// Get the student's roll number from session
$rollNumber = $_SESSION['roll_number'];

// Get today's date
$date = date("Y-m-d");

// Check if the student has already been marked present for today's date and subject
$sql = "SELECT * FROM attendance WHERE rollno = '$rollNumber' AND subject = '$subjectName' AND date = '$date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Student has already been marked present
    echo "<script>alert('You have already been marked present for $subjectName today.'); window.location.href = 'student-home.php';</script>";
} else {
    // Insert the attendance record for the student
    $sql = "INSERT INTO attendance (rollno, subject, date, status) VALUES ('$rollNumber', '$subjectName', '$date', 'Present')";
    if ($conn->query($sql) === TRUE) {
        // Attendance marked successfully
        echo "<script>alert('Attendance marked successfully for $subjectName'); window.location.href = 'student-home.php';</script>";
    } else {
        // Error occurred while marking attendance
        echo "<script>alert('Error occurred while marking attendance'); history.back();</script>";
    }
}

$conn->close();
?>
