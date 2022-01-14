<?php
    require_once("../includes/config.php");
    require_once("../includes/classes/SearchProvider.php");
    require_once("../includes/classes/EntityProvider.php");
    require_once("../includes/classes/Entity.php");
    require_once("../includes/classes/PreviewProvider.php");

    if(isset($_POST["term"]) && isset($_POST["username"])){
        $provider = new SearchProvider($con, $_POST["username"]);

        echo $provider->getResults($_POST["term"]);
    }
    else{
        echo "No term or username passed.";
    }
?>