<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'Database.php';
    $db = new Database();

   
    $title = $_POST['title'];
    $message = $_POST['message'];
    $category = $_POST['category'];

    $stmt = $db->conn->prepare("INSERT INTO blog (title, content, category_id) VALUES (:title, :content, :category_id)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $message);
    $stmt->bindParam(':category_id', $category);

    if ($stmt->execute()) {
        $_SESSION['blog_result'] = "Blog byl úspěšně vytvořen";
    } else {
        $_SESSION['blog_result'] = "Blog se nepodařilo vytvořit";
    }
    header("Location: blog.php");
    exit();
}
?>
