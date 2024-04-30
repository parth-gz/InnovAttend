<?php
// Start session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
    <script src="js/script.js"></script>
    <div class="header">
        
    </div>
    <div class="container">
        <div class="left-panel">
            <h3>MY PROFILE</h3>
            <div class="pic">

            </div>
            <div class="name">
               <p> <?php echo htmlspecialchars($_SESSION['first_name']) . " " . htmlspecialchars($_SESSION['last_name']); ?></p>
            </div>
            <div class="nm">
                <p>Class: <?php echo $_SESSION['class']; ?> </p>
            </div>
            <div class="nm">
                <p>Division: <?php echo $_SESSION['division']; ?> </p>
            </div>
            <div class="nm">
                <p>Roll number: <?php echo htmlspecialchars($_SESSION['roll_number']); ?></p>
            </div>
            <div class="nm">
                <p>PRN number: <?php echo htmlspecialchars($_SESSION['prn_number']); ?></p>
            </div>
        </div>
       <div class="right-container">
            <div class="panel">
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image1"></div>
                    <p>Mark Attendance</p>
                </button>
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image2"></div>
                    <p>View Attendance</p>
                </button>
                
            </div>
            <div class="panel">
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image4"></div>
                    <p>Class Schedule</p>
                </button>
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image3"></div>
                    <p>Contact Admin</p>
                </button>
            </div>
            <div class="panel">
                <button class="btn" id="nextButton" onclick="openWebpage()">Next</button>
            </div>
        </div>
    </div>
</body>
</html>
