<?php
session_start();
require_once 'Database.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['loggedin']) || $_SESSION['username'] !== 'admin') {
    header("Location: blog.php");
    exit();
}

$db = new Database();
$conn = $db->conn;

// Check if post ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$postId = $_GET['id'];

// Fetch post details from the database
$stmt = $conn->prepare("SELECT * FROM blog WHERE id = :id");
$stmt->bindParam(':id', $postId);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    // If post is not found, redirect to blog page
    header("Location: blog.php");
    exit();
}

// Fetch all categories
$stmt = $conn->prepare("SELECT * FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll();

// If form is submitted, update the post
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    // Update the post in the database
    $stmt = $conn->prepare("UPDATE blog SET title = :title, content = :content, category_id = :category WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content', $content);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':id', $postId);

    if ($stmt->execute()) {
        $_SESSION['blog_result'] = "Post successfully updated.";
    } else {
        $_SESSION['blog_result'] = "Error updating post.";
    }

    // Redirect back to blog page
    header("Location: blog.php");
    exit();
}
?>

<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/blog.css">
</head>
<body>

<div class="container-blog">
    <div class="form-box">
        <form id="editForm" action="" method="POST">
            <div>
                <label for="title">Nadpis:</label>
                <input type="text" id="title" name="title" value="<?= $post['title'] ?>" required>
            </div>
            <div>
                <label for="content">Zpráva:</label>
                <textarea id="content" name="content" required><?= $post['content'] ?></textarea>
            </div>
            <div>
                <label for="category">Kategorie:</label>
                <select id="category" name="category">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>" <?= ($category['id'] == $post['category_id']) ? 'selected' : '' ?>>
                            <?= $category['display_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="submit">Uložit změny</button>
        </form>
    </div>
</div>
</body>
</html>
