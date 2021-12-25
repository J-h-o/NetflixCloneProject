<?php
    if(isset($_POST["submitForm"])){
        echo "Form was submited";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register | Cloneflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
        <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    </head>
    <body>
        
        <div class="signInContainer">
            <div class="column">
                <div class="header">
                    
                    <img src="assets/images/logo.png" title="Logo" alt="Cloneflix">
                    <h3>Sign Up</h3>
                    <span>to enjoy our vast selection of movies and series!</span>
                    
                </div>
                <form method="POST" action="">

                    <input type="text" name="firstName" placeholder="First Name" required>
                    <input type="text" name="lastName" placeholder="Last Name" required>
                    <input type="text" name="username" placeholder="Username" required>
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="email" name="confirmEmail" placeholder="Confirm Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                    <input type="submit" name="submitForm" value="Sign-Up">

                </form>

                <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

            </div>
        </div>

    </body>
</html>