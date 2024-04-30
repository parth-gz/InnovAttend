<?php
include "db_connect.php";

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['roll_number'])) {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit();
}

// Get the entered token from the form submission
$enteredToken = $_POST['token'];

// Check if the tokens table is empty
$sql = "SELECT * FROM tokens";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // Token table is empty
    echo "<script>alert('Token Expired, report to your teacher'); window.location.href = 'student-home.php';</script>";
    exit();
}

// Validate the entered token and get the subject name from the tokens table
$sql = "SELECT subject_name FROM tokens WHERE token = '$enteredToken'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Token found, get the subject name
    $row = $result->fetch_assoc();
    $subjectName = $row['subject_name'];

    // Get student data from session
    $rollNumber = $_SESSION['roll_number'];
    $date = date("Y-m-d");
    $status = "Present";

    // Insert attendance data into the attendance table
    $insertSql = "INSERT INTO attendance (rollno, subject_name, date, status) VALUES ('$rollNumber', '$subjectName', '$date', '$status')";
    if ($conn->query($insertSql) === TRUE) {
        // Increment attendance count in count_student_attendance table
        $incrementSql = "INSERT INTO count_student_attendance (rollno, subject_name, attendance_count) 
                         VALUES ('$rollNumber', '$subjectName', 1) 
                         ON DUPLICATE KEY UPDATE attendance_count = attendance_count + 1";
        if ($conn->query($incrementSql) === TRUE) {
            // Attendance marked successfully
            echo "<script>alert('Attendance marked successfully'); window.location.href = 'student-home.php';</script>";
        } else {
            // Error in incrementing attendance count
            echo "<script>alert('Error in marking attendance');</script>";
        }
    } else {
        // Error in marking attendance
        echo "<script>alert('Error in marking attendance');</script>";
    }
} else {
    // Invalid token
    echo "<script>alert('Invalid token entered'); history.back();</script>";
}

$conn->close();
?>
