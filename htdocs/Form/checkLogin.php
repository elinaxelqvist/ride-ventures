<?php
include 'isLoggedIn.php';

// Check if a session exists
$response = array();
$response['loggedIn'] = isLoggedIn();

// Set the response content type to JSON
header('Content-Type: application/json');

// Send the response as JSON
$json =  json_encode($response);
echo $json;
?>