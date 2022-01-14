<?php
require_once("includes/classes/FormSanitizer.php");
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitForm"])){
                
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

        $success = $account->login($username,$password);
    
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
        <title>Login | Cloneflix</title>
        <link rel="stylesheet" type="text/css" href="assets/style/style.css"/>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
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
                        <?php 
                            echo $account->getError(Constants::$loginFail);
                        ?>
                    <input type="text" name="username" placeholder="Username" value="<?php getInputValue("username");?>" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" name="submitForm" value="Sign-In">

                </form>

                <a href="register.php" class="signInMessage">Don't have an account? Sign up here!</a>

            </div>
        </div>

    </body>
</html>