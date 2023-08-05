<?php

$logFilePath = "log.txt";

function registerUser($email, $password) {
    // Perform validation

    error_log("registerUser: email:" . $email . "\n", 3, $logFilePath);

// Establish connection to database

    $databasePath = 'db/elins.db';
    try {
        $pdo = new PDO("sqlite:$databasePath");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insert into user(email, password)

        $insertQuery = "insert into user (email, password) values (:email, :password)";
        $statement = $pdo->prepare($insertQuery);
        $statement->bindValue(':email', $email, SQLITE3_TEXT);
        $statement->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), SQLITE3_TEXT);
        $statement->execute();

        // Save the user id in the session
        $getQuery = "SELECT id from user where email = :email";
        $statement = $pdo->prepare($getQuery);
        $statement->bindValue(':email', $email, SQLITE3_TEXT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $userId = $result['id']; 
            error_log("registerUser: userId:" . $id . "\n", 3, $logFilePath);
            return $userId;
        } else {
            throw new PDOException('No user id found for ' . $email);
        }
    } catch (Exception $e) {
        error_log("Connection failed: " . $e->getMessage() . "\n", 3, $logFilePath);
        header('Location: error.html');
        exit();
    }
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate the fields
    if (empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: error.html');
        exit();
    }

    // // Call the registerUser function
    $userId = registerUser($email, $password);

    error_log("registerUser: userId (in main):" . $userId . "\n", 3, $logFilePath);
    error_log("registerUser: email:" . $email . "\n", 3, $logFilePath);

    session_start();
    // Store the email in the session
    $_SESSION["email"] = $email;
    $_SESSION["userId"] = $userId;
    error_log("registerUser: userId in session:" . $_SESSION["userId"] . "\n", 3, $logFilePath);

    header('Location: index.php');
}
?>