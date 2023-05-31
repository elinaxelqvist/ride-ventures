<?php
session_start();
$logFilePath = "log.txt";


// Check if a session exists
$response = array();

if (isset($_SESSION["userId"])) {
    // Session exists
    error_log("checkLogin: userId exists\n", 3, $logFilePath);
    $response['loggedIn'] = true;
} else {
    // Session does not exist
    error_log("checkLogin: userId does not exist\n", 3, $logFilePath);
    $response['loggedIn'] = false;
}

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the response as JSON
$json =  json_encode($response);
error_log("checkLlogin: " .  $json . "\n", 3, $logFilePath);
echo $json;
?>