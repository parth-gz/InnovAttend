<?php
// Database connection
include "db_connect.php";

// Generate random token
$token = substr(md5(uniqid(rand(), true)), 0, 6); // Adjust the length of the token as needed

// Get subject name from POST request
$subjectName = $_POST['subject_name'];

// Check if the subject already exists in the token_counts table
$checkSql = "SELECT * FROM token_counts WHERE subject_name = '$subjectName'";
$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows > 0) {
    // Subject already exists, update the token count
    $updateSql = "UPDATE token_counts SET token_count = token_count + 1 WHERE subject_name = '$subjectName'";
    if ($conn->query($updateSql) === TRUE) {
        // Insert the token into the tokens table
        $insertTokenSql = "INSERT INTO tokens (token, subject_name) VALUES ('$token', '$subjectName')";
        if ($conn->query($insertTokenSql) === TRUE) {
            // Return the generated token and success message
            echo "Your token is: $token\nToken count updated successfully for $subjectName";
        } else {
            echo "Error inserting token into tokens table: " . $conn->error;
        }
    } else {
        echo "Error updating token count: " . $conn->error;
    }
} else {
    // Subject doesn't exist, insert a new row with token count 1
    $insertSql = "INSERT INTO token_counts (subject_name, token_count) VALUES ('$subjectName', 1)";
    if ($conn->query($insertSql) === TRUE) {
        // Insert the token into the tokens table
        $insertTokenSql = "INSERT INTO tokens (token, subject_name) VALUES ('$token', '$subjectName')";
        if ($conn->query($insertTokenSql) === TRUE) {
            // Return the generated token and success message
            echo "Your token is: $token\nNew token count entry added for $subjectName";
        } else {
            echo "Error inserting token into tokens table: " . $conn->error;
        }
    } else {
        echo "Error inserting new token count entry: " . $conn->error;
    }
}

$conn->close();
?>
