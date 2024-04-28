<?php
// Start session
session_start();

// Include the database connection script
include "db_connect.php";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to check if email and password match
    $sql = "SELECT * FROM Students WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if a matching record was found
    if ($result->num_rows == 1) {
        // Email and password match, retrieve student data
        $student_data = $result->fetch_assoc();
        
        // Store user profile data in session variables
        $_SESSION['first_name'] = $student_data['first_name'];
        $_SESSION['last_name'] = $student_data['last_name'];
        $_SESSION['class'] = $student_data['class'];
        $_SESSION['division'] = $student_data['division'];
        $_SESSION['roll_number'] = $student_data['rollno'];
        $_SESSION['prn_number'] = $student_data['prn'];

        // Redirect to student-home.php
        header("Location: student-home.php");
        exit();
    } else {
        // Email and password don't match, display alert message
        echo "<script>alert('Incorrect Email or password');</script>";
    }
}

// Close connection
$conn->close();
?>
