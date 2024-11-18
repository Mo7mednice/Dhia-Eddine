function openLoginModal() {
    Swal.fire({
        title: 'Login',
        html:
            '<input id="card-number" class="swal2-input" placeholder="Card Number" required>',
        focusConfirm: false,
        preConfirm: () => {
            const cardNumber = Swal.getPopup().querySelector('#card-number').value;
            if (!cardNumber) {
                Swal.showValidationMessage('Please enter a card number');
            }
            return cardNumber;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            openUsernamePasswordModal(result.value);
        }
    });
}

function openUsernamePasswordModal(cardNumber) {
    Swal.fire({
        title: 'Login',
        html:
            '<input id="username" class="swal2-input" placeholder="Username" required>' +
            '<input type="password" id="password" class="swal2-input" placeholder="Password" required>',
        focusConfirm: false,
        preConfirm: () => {
            const username = Swal.getPopup().querySelector('#username').value;
            const password = Swal.getPopup().querySelector('#password').value;

            if (!username || !password) {
                Swal.showValidationMessage('Please enter both username and password');
            }

            // Send card number, username, and password to the server for verification
            checkLoginCredentials(cardNumber, username, password);
        }
    });
}

function checkLoginCredentials(cardNumber, username, password) {
    // Send the data to the server for verification using AJAX
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Response from the server
            var response = xhr.responseText;

            // Check if the login credentials are valid
            if (response === "valid") {
                Swal.fire({
                    title: "Success!",
                    text: "Login successful.",
                    icon: "success"
                });
            } else {
                Swal.fire({
                    title: "Error!",
                    text: "Invalid login credentials. Please try again.",
                    icon: "error"
                });
            }
        }
    };

    // Replace 'verify_login.php' with the actual PHP file that checks the login credentials in your database
    xhr.open("POST", "verify_login.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("cardNumber=" + cardNumber + "&username=" + username + "&password=" + password);
}
