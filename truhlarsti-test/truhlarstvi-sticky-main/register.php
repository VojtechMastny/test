<?php

require_once 'Database.php';
$db = new Database();

session_start();

if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = password_hash($_POST['password'], PASSWORD_ARGON2ID);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $db->conn->prepare("INSERT INTO users (email, username, password) VALUES (:email, :username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);

        $stmt->execute();

        // Automatically log in user after registration
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: dashboard.php');
    } else {
        echo 'Invalid email address!';
    }
} else {
    echo 'Please fill all the fields!';
}

?>