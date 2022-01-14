<?php
$hideNav = true;
require_once("includes/header.php");
require_once("includes/classes/Video.php");
require_once("includes/classes/VideoProvider.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("No id specified");
}

$video = new Video($con,$_GET["id"]);
$video->incrementViews();
$upNextVideo = VideoProvider::getUpNext($con,$video);
$thumbnail = $video->getThumbnail();
?>

<div class="watchContainer">
    <div class="videoControls watchNav">
        <button class="transparent iconButton" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>

    <div class="videoControls upNext" style="display:none">
        <button onClick="restartVideo();"><i class="fas fa-redo"></i></button>
        <div class="upNextContainer">
            <h2>Up next:</h2>
            <img class="upNextThumbnail" src="<?php echo $thumbnail ?>">
            <h3><?php echo $upNextVideo->getTitle(); ?></h3>
            <h3><?php echo $video->getSeasonAndEpisode();?></h3>
            <button onClick="playNext(<?php echo $upNextVideo->getId();?>);"class="playNext"><i class="fas fa-play"></i> Play</button>
        </div>
    </div>

    <video controls autoplay onEnded="showUpNext()">
        <source src='<?php echo $video->getFilePath();?>' type='video/mp4'/>
    </video>
</div>

<script>
    initVideo("<?php echo $video->getId();?>","<?php echo $userLoggedIn;?>");
</script>