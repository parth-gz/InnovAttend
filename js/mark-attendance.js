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
}

function generateAndStoreToken() {
    // Determine which box is selected
    var selectedBox = document.querySelector('.box.active');
    var boxText = selectedBox.querySelector('p').innerText;

    // Open the corresponding HTML file based on the selected box
    if (boxText === 'OSA' || boxText === 'ADS' || boxText === 'EM3' || boxText === 'SE' || boxText === 'DBMS' || boxText === 'CR' || boxText === 'MPL') {
        var token = generateRandomToken();
        // AJAX call to store the token in the database
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "store-token.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Display the generated token in an alert
                alert("Your token is: " + token);
            }
        };
        xhr.send("token=" + token);
    } else {
        alert("Please select a subject first.");
    }
}
