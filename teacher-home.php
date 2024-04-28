<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Home</title>
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
               <p> <?php echo htmlspecialchars($_GET['first_name']) . " " . htmlspecialchars($_GET['last_name']); ?></p>
            </div>
            <div class="nm">
                <p>Teacher ID: <?php echo $_GET['teacher_id']; ?></p>
            </div>
            <div class="nm">
                <p>Email: <?php echo $_GET['email']; ?></p>
            </div>
        </div>
       <div class="right-container">
            <div class="panel">
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image1"></div>
                    <p>Generate Token</p>
                </button>
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image2"></div>
                    <p>Add Student</p>
                </button>
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image3"></div>
                    <p>View Attendance</p>
                </button>
            </div>
            <div class="panel">
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image4"></div>
                    <p>Display Defaulters</p>
                </button>
                <button class="box" onclick="lightUpNextButton(this)">
                    <div class="image5"></div>
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
