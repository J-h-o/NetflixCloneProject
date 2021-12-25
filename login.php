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
            <div class="columnLogin">
                <div class="header">
                    
                    <img src="assets/images/logo.png" title="Logo" alt="Cloneflix">
                    <h3>Sign In</h3>
                    <span>to enjoy our vast selection of movies and series!</span>
                    
                </div>
                <form method="POST" action="">

                    <input type="text" name="username" placeholder="Username" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" name="submitForm" value="Sign-Up">

                </form>

                <a href="register.php" class="signInMessage">Don't have an account? Sign up here!</a>

            </div>
        </div>

    </body>
</html>