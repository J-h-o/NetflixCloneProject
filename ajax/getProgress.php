<?php
    require_once("../includes/config.php");
    require_once("../includes/classes/Video.php");

    if(isset($_POST["videoId"]) && isset($_POST["username"])){
        $query = $con->prepare("SELECT progress from videoProgress WHERE username = :username AND videoId=:videoId");
        $query->bindValue(':username', $_POST["username"]);
        $query->bindValue(':videoId', $_POST["videoId"]);

        $query->execute();

        echo $query->fetchColumn();
    }
    else{
        echo "No videoId or username passed.";
    }
?>