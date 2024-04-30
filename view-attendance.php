<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Attendance</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php
    include "db_connect.php"; // Include your database connection file

    // Start session
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['roll_number'])) {
        // Redirect to login page or handle unauthorized access
        header("Location: login.php");
        exit();
    }

    // Get logged in student's roll number
    $rollNumber = $_SESSION['roll_number'];

    // Query to get total attendance count for each subject
    $attendanceQuery = "SELECT subject_name, attendance_count FROM count_student_attendance WHERE rollno = $rollNumber";

    // Query to get token count for each subject from token_counts table
    $tokenQuery = "SELECT subject_name, token_count FROM token_counts";

    // Execute queries
    $attendanceResult = $conn->query($attendanceQuery);
    $tokenResult = $conn->query($tokenQuery);

    // Create an associative array to store total attendance for each subject
    $attendance = array();
    while ($row = $attendanceResult->fetch_assoc()) {
        $attendance[$row['subject_name']] = $row['attendance_count'];
    }

    // Create a table to display attendance
    echo "<h2>Student Attendance</h2>";
    echo "<table>";
    echo "<tr><th>Subject</th><th>Total Attendance</th><th>Percentage Attendance</th></tr>";
    
    // Iterate over each subject to display attendance and percentage
    while ($row = $tokenResult->fetch_assoc()) {
        $subjectName = $row['subject_name'];
        $tokenCount = $row['token_count'];
        $attendanceCount = isset($attendance[$subjectName]) ? $attendance[$subjectName] : 0;
        $totalAttendance = $attendanceCount . " / " . $tokenCount;
        $percentageAttendance = $tokenCount > 0 ? round(($attendanceCount / $tokenCount) * 100, 2) : 0;
        
        echo "<tr><td>$subjectName</td><td>$totalAttendance</td><td>$percentageAttendance%</td></tr>";
    }

    echo "</table>";

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
