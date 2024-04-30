

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
    var subjectName = box.getAttribute('name');

    // Set the subject name in the hidden input field
    document.getElementById('subjectInput').value = subjectName;
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
