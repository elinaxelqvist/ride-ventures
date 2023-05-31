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
        header('Location: index.html');

    } catch (PDOException $e) {
        error_log("postComment: " . $e->getMessage() . "\n", 3, $logFilePath);

        header('Location: error.html');
    }
} 

function validateComment($comment) {
    if (empty($comment)) {
        header('Location: index.html');
        exit();
    }
}
// Main
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $comment = $_POST["comment"];
    $userId = $_SESSION["userId"];
    $userIdAsInt = intval($userId);
    
    validateComment($comment);

    error_log("postComment: userId: " . $userIdAsInt . "\n", 3, $logFilePath);
    error_log("postComment: comment: " . $comment . "\n", 3, $logFilePath);

    
    // // Call the registerUser function
    postComment($userIdAsInt, $comment);
}
?>