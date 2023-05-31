<?php

$logFilePath = "log.txt";

function getComments() {

    // Establish a connection to the database
    try {
        // connect to DB
        $databasePath = 'db/elins.db';
        $pdo = new PDO("sqlite:$databasePath");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Add comment, using userId that is found in session
        //SELECT u.email, c.comment FROM user u JOIN content c ON c.user_id = u.id ORDER BY c.id;
        $selectQuery = "select u.email,c.comment from user u join content c on c.user_id = u.id order by c.id";
        $result = $pdo->query($selectQuery);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $rows;

    } catch (PDOException $e) {
        error_log("postComment: " . $e->getMessage() . "\n", 3, $logFilePath);

        header('Location: index.html');
    }
} 

// Main
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $rows = getComments();
    $jsonComments = json_encode($rows);
    
    error_log("getComments: rows[0].comment: " . $rows[0]["comment"] . "\n", 3, $logFilePath);
    error_log("getComments: json: " . $jsonComments . "\n", 3, $logFilePath);

    header('Content-Type: application/json');
    echo $jsonComments;
}
?>