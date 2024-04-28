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
        // Email and password match, retrieve student data
        $student_data = $result->fetch_assoc();
        
        // Redirect to student-home.html with student data appended as query parameters
        header("Location: student-home.php?first_name={$student_data['first_name']}&last_name={$student_data['last_name']}&class={$student_data['class']}&division={$student_data['division']}&roll_number={$student_data['rollno']}&prn_number={$student_data['prn']}");
        exit();
    } else {
        // Email and password don't match, display alert message
        echo "<script>alert('Incorrect Email or password');</script>";
    }
}

// Close connection
$conn->close();
?>
