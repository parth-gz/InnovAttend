<?php
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
        // Email and password match, redirect to student-home.html
        header("Location: student-home.html");
        exit();
    } else {
        // Email and password don't match, display alert message
        echo "<script>alert('Incorrect Email or password');</script>";
    }
}

// Close connection
$conn->close();
?>
