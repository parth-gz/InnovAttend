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
}

function openWebpage() {
    // Check if the next button is active (blue)
    var nextButton = document.getElementById("nextButton");
    var nextButtonColor = window.getComputedStyle(nextButton).getPropertyValue('background-color');
    if (nextButtonColor === 'rgb(0, 105, 243)') {
        // Determine which box is selected
        var selectedBox = document.querySelector('.box.active');
        var boxText = selectedBox.querySelector('p').innerText;

        // Open the corresponding HTML file based on the selected box
        if (boxText === 'Student') {
            window.location.href = "student-login.html";
        } else if (boxText === 'Teacher') {
            window.location.href = "teacher-login.html";
        } else if (boxText === 'Admin/Owner') {
            window.location.href = "admin-login.html";
        }

        else if (boxText === 'Mark Attendance') {
            window.location.href = "mark-attendance.html";
        }
        else if (boxText === 'View Attendance') {
            window.location.href = "view-attendance.html";
        }
        else if (boxText === 'Contact Admin') {
            window.location.href = "contact-admin.html";
        }
        else if (boxText === 'Class Schedule') {
            window.location.href = "class-schedule.html";
        }
        else if (boxText === 'Request Leave') {
            window.location.href = "request-leave.html";
        }
    } else {
        // Button is gray, do nothing
        alert("Please select an option first.");
    }
}
