<?php
include 'db_connect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to select user with provided email and password
    $sql = "SELECT * FROM Teachers WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User with provided email and password exists, redirect to home.html
        header("Location: teacher-home.html");
        exit();
    } else {
        // No user found with provided email and password, display alert message
        echo "<script>alert('Wrong password or email ID');</script>"; // Show alert message
        echo "<script>window.location.href = 'teacher-login.html';</script>"; // Redirect back to login page
        exit();
    }
}

// Close connection
$conn->close();
?>
