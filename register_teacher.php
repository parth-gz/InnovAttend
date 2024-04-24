<?php
// Include the database connection script
include "db_connect.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $teacher_id = $_POST['teacher_id'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email already exists
    $email_check_sql = "SELECT * FROM Teachers WHERE email = '$email'";
    $email_result = $conn->query($email_check_sql);
    if ($email_result->num_rows > 0) {
        // Email already exists, display alert message
        echo "<script>alert('Email already exists');</script>";
        // Redirect back to registration page
        echo "<script>window.location.href = 'teacher-register.html';</script>";
        exit();
    }

    // Check if teacher ID already exists
    $teacher_id_check_sql = "SELECT * FROM Teachers WHERE teacher_id = '$teacher_id'";
    $teacher_id_result = $conn->query($teacher_id_check_sql);
    if ($teacher_id_result->num_rows > 0) {
        // Teacher ID already exists, display alert message
        echo "<script>alert('Teacher ID already exists');</script>";
        // Redirect back to registration page
        echo "<script>window.location.href = 'teacher-register.html';</script>";
        exit();
    }

    // If email and teacher ID do not exist, proceed with registration
    // Prepare and execute SQL statement to insert data into the table
    $sql = "INSERT INTO Teachers (first_name, last_name, teacher_id, email, password) 
            VALUES ('$first_name', '$last_name', '$teacher_id', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, display alert message
        echo "<script>alert('Registration successful');</script>";
        // Redirect to login page
        echo "<script>window.location.href = 'teacherlogin.html';</script>";
        exit();
    } else {
        // Error occurred during registration, display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
