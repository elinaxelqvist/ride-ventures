<?php

$logFilePath = "log.txt";

function loginUser($email, $password) {
    // Perform validation

    error_log("loginUser: email:" . $email . "\n", 3, $logFilePath);
 

// Establish connection to database

    $databasePath = 'db/elins.db';
    try {
        $pdo = new PDO("sqlite:$databasePath");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Set the user id in the session
        $getQuery = "SELECT id,password from user where email = :email";
        $statement = $pdo->prepare($getQuery);
        $statement->bindValue(':email', $email, SQLITE3_TEXT);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $userId = $result['id']; 
            $hashedPassword = $result['password']; 
            error_log("loginUser: userId:" . $id . "\n", 3, $logFilePath);

            if (password_verify($password, $hashedPassword)) {
                return $userId;
            } else {
                error_log("loginUser: Wrong password\n", 3, $logFilePath);
                header('Location: error.html');
                exit();
            }
        } else {
            header('Location: error.html');
            exit();
        }
    } catch (PDOException $e) {
        error_log("Error: " . $e->getMessage() . "\n", 3, $logFilePath);
        header('Location: error.html');
        exit();
    }
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];


    error_log("loginUser (main): email:" . $email . "\n", 3, $logFilePath);
    // // Call the login function
    $userId = loginUser($email, $password);

    session_start();
    // Store the email in the session
    $_SESSION["email"] = $email;
    $_SESSION["userId"] = $userId;
    error_log("loginUser: userId in session:" . $_SESSION["userId"] . "\n", 3, $logFilePath);

    header('Location: index.php');
}
?>