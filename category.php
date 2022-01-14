<?php 
require_once("includes/header.php");

if(!isset($_GET["id"])){
    ErrorMessage::show("No id specified");
}

$preview = new PreviewProvider($con, $userLoggedIn);
echo $preview->createCategoryPreview($_GET["id"]);

$container = new CategoryContainers($con, $userLoggedIn);
echo $container->showCategory($_GET["id"]);
?>