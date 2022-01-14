<?php 
require_once("includes/header.php");
require_once("includes/classes/VideoProvider.php");
require_once("includes/classes/Video.php");

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createMovieShowPreview(null);

$container = new CategoryContainers($con, $userLoggedIn);
echo $container->showMovieCategories();
?>