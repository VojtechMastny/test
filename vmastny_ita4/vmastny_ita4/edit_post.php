<?php
session_start();
require_once 'Database.php';


if (!isset($_SESSION['loggedin']) || $_SESSION['username'] !== 'admin') {
    header("Location: blog.php");
    exit();
}

$db = new Database();
$conn = $db->conn;


if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$postId = $_GET['id'];


$stmt = $conn->prepare("SELECT * FROM blog WHERE id = :id");
$stmt->bindParam(':id', $postId);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
 
    header("Location: blog.php");
    exit();
}


$stmt = $conn->prepare("SELECT * FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll();


if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

  
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<header>
        <div class="navber">
            <nav class="nav">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Domů</a>
                    </li>
                    <li class="nav-item">
                        <a href="gallery.php" class="nav-link">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a href="blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="calcu.php" class="nav-link">Kalkulace</a>
                    </li>
                    <li class="nav-item">
                        <a href="kontakty.php" class="nav-link">Kontakty</a>
                    </li>
                    <li class="nav-item">
    <?php if (isset($_SESSION['loggedin'])): ?>
        <a href="logout.php" class="nav-link">Odhlásit</a>
    <?php else: ?>
        <a href="login.php" class="nav-link">Přihlášení</a>
    <?php endif; ?>
</li>

                </ul>

                <div class="hamburger">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
            </nav>
        </div>
    </header>
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


<footer class="footer-2">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                <ul>
                        <li><a href="index.php">Domů</a></li>
                        <li><a href="gallery.php">Galerie</a></li>
                        <li><a href="bloh.php">Blog</a></li>
                        <li><a href="kontakty.php">Kontakty</a></li>

                    </ul>
                    <h4>Stanislav malec</h4>
                    <a href="https://www.facebook.com/p/Truhlářství-Stanislav-Malec-100076198327108/?paipv=0&eav=AfZwSJe-0NwwJoTv4_7JWzl2KZR-rZvbWiXpyuxbPZH_vWU9KKEx_elzbCjqQXgd8kI&_rdr" target="_blank">
      <i class="fab fa-facebook-square"></i>
    </a>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/scripts/script.js"></script>
</body>
</html>
