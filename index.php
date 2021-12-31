<?php 
require_once("includes/header.php");

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createPreviewVideo(null);

$container = new CategoryContainers($con, $userLoggedIn);
echo $container->showAllCategories();
?>