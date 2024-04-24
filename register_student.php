<?php
// Include the database connection script
include "db_connect.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $prn_number = $_POST['prn_number'];
    $class = $_POST['class'];
    $division = $_POST['division'];
    $roll_number = $_POST['roll_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $email_check_sql = "SELECT * FROM Students WHERE email = '$email'";
    $email_result = $conn->query($email_check_sql);
    if ($email_result->num_rows > 0) {
        // Email already exists, display alert message
        echo "<script>alert('Email already exists');</script>";
        // Redirect back to registration page
        echo "<script>window.location.href = 'student-register.html';</script>";
        exit();
    }

    // Check if PRN number already exists
    $prn_check_sql = "SELECT * FROM Students WHERE prn = '$prn_number'";
    $prn_result = $conn->query($prn_check_sql);
    if ($prn_result->num_rows > 0) {
        // PRN number already exists, display alert message
        echo "<script>alert('PRN number already exists');</script>";
        // Redirect back to registration page
        echo "<script>window.location.href = 'student-register.html';</script>";
        exit();
    }

    // If email and PRN number do not exist, proceed with registration
    // Prepare and execute SQL statement to insert data into the table
    $sql = "INSERT INTO Students (first_name, last_name, prn, class, division, rollno, email, password) 
            VALUES ('$first_name', '$last_name', '$prn_number', '$class', '$division', '$roll_number', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, display alert message
        echo "<script>alert('Registration successful');</script>";
        // Redirect to login page or any other page
        echo "<script>window.location.href = 'studentlogin.html';</script>";
        exit();
    } else {
        // Error occurred during registration, display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
