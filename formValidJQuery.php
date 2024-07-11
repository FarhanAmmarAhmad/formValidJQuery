<!DOCTYPE html>
<html>
<head>
    <title>Form Validation with AJAX</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h1>git Remote Repository Test</h1>
    <h2>Registration Form</h2>
    <form id="registrationForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        
        <label for="email">Email:</label>
        <input type="text" id="email" name="email"><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        
        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword"><br><br>
        
        <button type="submit">Submit</button>
    </form>
    
    <div id="errorMessages"></div>
    <div id="successMessage"></div>

    <script>
        $(document).ready(function(){
            $("#registrationForm").submit(function(event){
                // Prevent the default form submission
                event.preventDefault();
                
                // Clear previous error messages
                $("#errorMessages").empty();
                $("#successMessage").empty();

                // Perform form validation
                let isValid = true;
                let errorMessages = "";

                // Validate name
                if ($("#name").val().trim() === "") {
                    isValid = false;
                    errorMessages += "<p class='error'>Name is required.</p>";
                }

                // Validate email
                let email = $("#email").val().trim();
                let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                if (email === "") {
                    isValid = false;
                    errorMessages += "<p class='error'>Email is required.</p>";
                } else if (!emailPattern.test(email)) {
                    isValid = false;
                    errorMessages += "<p class='error'>Invalid email format.</p>";
                }

                // Validate password
                let password = $("#password").val().trim();
                if (password === "") {
                    isValid = false;
                    errorMessages += "<p class='error'>Password is required.</p>";
                }

                // Validate confirm password
                let confirmPassword = $("#confirmPassword").val().trim();
                if (confirmPassword === "") {
                    isValid = false;
                    errorMessages += "<p class='error'>Confirm password is required.</p>";
                } else if (password !== confirmPassword) {
                    isValid = false;
                    errorMessages += "<p class='error'>Passwords do not match.</p>";
                }

                // If the form is valid, submit it using AJAX
                if (isValid) {
                    let formData = {
                        name: $("#name").val().trim(),
                        email: $("#email").val().trim(),
                        password: $("#password").val().trim()
                    };

                    $.ajax({
                        url: "server_endpoint.php", // Replace with your server endpoint
                        type: "POST",
                        data: formData,
                        success: function(response) {
                            $("#successMessage").html("<p class='success'>Form submitted successfully!</p>");
                        },
                        error: function(xhr, status, error) {
                            $("#errorMessages").html("<p class='error'>An error occurred: " + error + "</p>");
                        }
                    });
                } else {
                    // Display error messages
                    $("#errorMessages").html(errorMessages);
                }
            });
        });
    </script>
</body>
</html>
