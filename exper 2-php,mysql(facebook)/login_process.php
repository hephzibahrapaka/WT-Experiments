<?php
session_start();
 
// Check if the user has submitted the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $conn = new mysqli('localhost', 'root', '', 'facebook');
 
    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
 
    // Check if the query returned any rows
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        echo 'Invalid username or password';
    }
}
