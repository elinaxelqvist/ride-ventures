<?php


// Function to check if the user is logged in based on the presence of 'userId' in the session
function isLoggedIn() {
  $logFilePath = "log.txt";
  // Start or resume the session
  session_start();

  // Check if 'userId' exists in the session and if it has a non-empty value
  if (isset($_SESSION['userId']) && !empty($_SESSION['userId'])) {
    // User is logged in
    error_log("isLoggedIn: true" . "\n", 3, $logFilePath);
    return true;
  } else {
    // User is not logged in
    error_log("isLoggedIn: false" . "\n", 3, $logFilePath);
    return false;
  }
}
?>
