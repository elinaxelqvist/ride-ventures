<?php
session_start();

$logFilePath = "log.txt";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    unset($_SESSION["userId"]);
    header('Location: index.php');
}
?>