<?php
require_once("includes/classes/FormSanitizer.php");
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitForm"])){
        
        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $confirmPassword = FormSanitizer::sanitizeFormPassword($_POST["confirmPassword"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $confirmEmail = FormSanitizer::sanitizeFormEmail($_POST["confirmEmail"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

        $success = $account->register($firstName,$lastName,$username,$email,$confirmEmail,$password,$confirmPassword);
    
        if($success){
            $_SESSION["userLoggedIn"] = $username;
            header("Location: index.php");
        }
    }

    function getInputValue($name)
    {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Register | Cloneflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
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
                    
                        <?php 
                            echo $account->getError(Constants::$firstNameCharacters);
                        ?>
                    <input type="text" name="firstName" placeholder="First Name" value="<?php getInputValue("firstName");?>" required>

                        <?php 
                            echo $account->getError(Constants::$lastNameCharacters);
                        ?>
                    <input type="text" name="lastName" placeholder="Last Name" value="<?php getInputValue("lastName");?>" required>

                        <?php 
                            echo $account->getError(Constants::$usernameCharacters);
                        ?>
                        <?php 
                            echo $account->getError(Constants::$usernameExists);
                        ?>
                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username");?>" required>
                        <?php
                            echo $account->getError(Constants::$emailCharacters);
                        ?>
                        <?php
                            echo $account->getError(Constants::$emailValid);
                        ?>
                        <?php
                            echo $account->getError(Constants::$emailTaken);
                        ?>
                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email");?>" required>
                    <input type="email" name="confirmEmail" placeholder="Confirm Email" value="<?php getInputValue("confirmEmail");?>" required>
                        <?php
                            echo $account->getError(Constants::$passwordCharacters);
                        ?>
                        <?php
                            echo $account->getError(Constants::$passwordMatch);
                        ?>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="password" name="confirmPassword" placeholder="Confirm Password" required>
                    
                    <input type="submit" name="submitForm" value="Sign-Up">

                </form>

                <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

            </div>
        </div>

    </body>
</html>