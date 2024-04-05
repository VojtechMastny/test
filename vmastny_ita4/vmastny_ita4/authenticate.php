<?php

require_once 'Database.php'; 
$db = new Database();

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['error'] = 'Please fill both the username and password fields!';
        header("Location: login.php");
        exit;
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

   
    $stmt = $db->conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    
    $stmt->execute();


    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
      
        if (password_verify($password, $user['password'])) {
           
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['username']; 
            
            
            header("Location: dashboard.php");
            exit;
        } else {
           
            $_SESSION['error'] = 'Špatně zadané jméno nebo heslo.';
            header("Location: login.php");
            exit;
        }
    } else {
        
        $_SESSION['error'] = 'Špatně zadané jméno nebo heslo.';
        header("Location: login.php");
        exit;
    }
} else {
   
    header("Location: login.php");
    exit;
}

?>
