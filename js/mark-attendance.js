function generateRandomToken() {
    // Generate a random 6-digit token
    var token = Math.floor(100000 + Math.random() * 900000);
    return token;
}

function lightUpNextButton(box) {
    // Remove the active class from all boxes
    var boxes = document.querySelectorAll('.box');
    boxes.forEach(function(box) {
        box.classList.remove('active');
    });

    // Add active class to the clicked box
    box.classList.add('active');

    // Set next button color to blue
    document.getElementById("nextButton").style.backgroundColor = "#0069f3";

    // Get the subject name from the clicked box
    var subjectName = box.querySelector('p').innerText;

    // Set the subject name in the hidden input field
    document.getElementById('subjectInput').value = subjectName;
}

function generateAndStoreToken() {
    // Determine which box is selected
    var selectedBox = document.querySelector('.box.active');
    var subjectName = selectedBox.querySelector('p').innerText;

    // AJAX request to PHP script to generate and store token
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "store-token.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var token = xhr.responseText;
            alert("Your token is: " + token);
        }
    };
    xhr.send("subject_name=" + subjectName);
}

// Function to handle form submission
function handleFormSubmission(event) {
    event.preventDefault(); // Prevent the default form submission

    // AJAX request to PHP script to mark attendance
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "mark-attendance.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Display the response from mark-attendance.php
            alert(xhr.responseText);
            // Redirect to student-home.php if attendance marked successfully
            if (xhr.responseText.includes("Attendance marked successfully")) {
                window.location.href = 'student-home.php';
            }
        }
    };

    // Get form data
    var formData = new FormData(document.getElementById('attendanceForm'));

    // Send form data
    xhr.send(formData);
}

// Attach the handleFormSubmission function to the form's submit event
document.getElementById('attendanceForm').addEventListener('submit', handleFormSubmission);
