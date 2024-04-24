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
            window.location.href = "studentlogin.html";
        } else if (boxText === 'Teacher') {
            window.location.href = "teacherlogin.html";
        } else if (boxText === 'Admin/Owner') {
            window.location.href = "adminlogin.html";
        }
    } else {
        // Button is gray, do nothing
        alert("Please select an option first.");
    }
}
