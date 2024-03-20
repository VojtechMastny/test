<?php

require_once 'Database.php';
$db = new Database();

session_start();


if (!isset($_POST['username'], $_POST['password'])) {
    exit('Please fill both the username and password fields!');
}

//Sanitize username
$username = $_POST['username'] = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$stmt = $db->conn->prepare("SELECT * FROM users WHERE username = :username");
$stmt->bindParam(':username', $_POST['username']);

$stmt->execute();

//IF username exists
if ($stmt->rowCount() > 0) {
    $user = $stmt->fetch();

    //IF password is correct
    if (password_verify($_POST['password'], $user['password'])) {

        $_SESSION['loggedin'] = true;

        $_SESSION['admin'] = true;

        $_SESSION['username'] = $_POST['username'];

        // Redirect to dashboard and exit script
        header('Location: dashboard.php');
        exit;
    } else {
        // Incorrect password
        echo 'Incorrect username and/or password!';
    }
} else {
    // Incorrect username
    echo 'Incorrect username and/or password!';
}


?>