<?php 
require_once("PayPal-PHP-SDK/autoload.php");
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AUsUWtUBXRwAgRkHYg1o-G1JFzpwZo7Kmle4HKQydtoNP_mKzZdsSBns9ifswGUy4eb7v4ZYMpBn8S0i',     // ClientID
        'ELPz4hMpeRH7ffvt9jAYzpaHl9eA2G2HelolMm_IOb9n7f7MokIe-NSTmWR0vmW5Qro1raoVZGmZ4RAE'      // ClientSecret
    )
);
?>