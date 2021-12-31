<?php
$hideNav = true;
require_once("includes/header.php");
require_once("includes/classes/Video.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("No id specified");
}

$video = new Video($con,$_GET["id"]);
$video->incrementViews();
?>

<div class="watchContainer">
    <div class="videoControls watchNav">
        <button class="transparent iconButton" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>
    <video controls autoplay>
        <source src='<?php echo $video->getFilePath();?>' type='video/mp4'/>
    </video>
</div>

<script>
    initVideo("<?php echo $video->getId();?>","<?php echo $userLoggedIn;?>");
</script>