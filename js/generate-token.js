function generateRandomToken() {
    // Generate a random 6-digit token
    var token = Math.floor(100000 + Math.random() * 900000);
    return token;
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
            var response = xhr.responseText;
            var parts = response.split('\n');
            var token = parts[0];
            var message = parts[1];
            alert(message + "\n" + "Token: " + token);
        }
    };
    xhr.send("subject_name=" + subjectName);
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
}