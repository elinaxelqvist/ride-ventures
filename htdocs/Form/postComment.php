<?php

session_start();

$logFilePath = "log.txt";

function postComment($userId, $comment) {

    // Establish a connection to database
    try {

        // connect to DB
        $databasePath = 'db/elins.db';
        $pdo = new PDO("sqlite:$databasePath");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Add comment, using userId that is found in session
        // Insert into content
        $insertQuery = "insert into content(comment, user_id) VALUES (:comment, :userId)";
        $statement = $pdo->prepare($insertQuery);
        
        $statement->bindValue(':comment', $comment, SQLITE3_TEXT);
        $statement->bindValue(':userId', $userId, SQLITE3_INTEGER);
        $statement->execute();
    } catch (PDOException $e) {
        throw new Exception("postComment: " . $e->getMessage());
    }
} 

function validateUserLoggedIn() {
   if (!isset($_SESSION["userId"])) {       
        throw new Exception("postComment: Undefined user is not allowed");
    }
}

function getUserId() {        
    $userId = $_SESSION["userId"];
    return intval($userId);
 }

function validateComment($comment) {
    if (empty($comment)) {
        throw new Exception("postComment: Empty comment is not allowed");
    }
}
// Main
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {        
        validateUserLoggedIn();
        $userId = getUserId();

        $comment = $_POST["comment"];
        validateComment($comment);
    
        error_log("postComment: userId: " . $userId . "\n", 3, $logFilePath);
        error_log("postComment: comment: " . $comment . "\n", 3, $logFilePath);
    
        postComment($userId, $comment);
        header('Location: index.php');
    } catch (Exception $e) {
        error_log($e->getMessage(). "\n", 3, $logFilePath);
        header('Location: error.html');
    }
}
?>
