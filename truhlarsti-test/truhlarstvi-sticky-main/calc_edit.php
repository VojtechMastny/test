<?php
session_start();
require_once 'Database.php';
$db = new Database();
$conn = $db->conn;

$postId = isset($_GET['id']) ? $_GET['id'] : null;

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $id = $_POST['id'];
    $price = $_POST['price'];
 
    // Update the post in the database
    $stmt = $conn->prepare("UPDATE calc SET title = :title, price = :price WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['calc_result'] = "Post successfully updated.";
    } else {
        $_SESSION['calc_result'] = "Error updating post.";
    }

    // Redirect back to the calculation page
    header("Location: calcu.php");
    exit();
}

// Fetch post details
$post = null;
if ($postId) {
    $stmt = $conn->prepare("SELECT * FROM calc WHERE id = :id");
    $stmt->bindParam(':id', $postId);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="cs-cz" dir="ltr">
<head> 
  <meta charset="UTF-8"> 
  <meta id="viewport" name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1, user-scalable=no">
  <link rel="stylesheet" href="assets/styles/calc.css">
  <link rel="stylesheet" href="assets/styles/style.css">
</head>
<body>
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
                        <a href="kontakty.html" class="nav-link">Kontakty</a>
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





    <?php if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin'): ?>
<div class="container-calc"> 
    <div class="form-box">
        <form id="contactForm" action="" method="POST">
            <input type="hidden" name="id" value="<?= $post['id'] ?>"> <!-- Add this hidden input for id -->
            <div>
                <label for="title">Název:</label>
                <input type="text" id="title" name="title" value="<?= $post['title'] ?>" required>
            </div>
            <div>
                <label for="price">Cena:</label>
                <input type="number" id="price" name="price" value="<?= $post['price'] ?>" required>
            </div>   
            <button type="submit" name="submit">Odeslat</button>
        </form>
    </div>
</div>
<?php endif; ?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <ul>
                    <li><a href="index.html">Domů</a></li>
                    <li><a href="gallery.html">Galerie</a></li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="kontakty.html">Kontakty</a></li>
                </ul>
                <h4>Stanislav malec</h4>
            </div>
        </div>
    </div>
</footer>
</body>
<script src="assets/scripts/script.js"></script>
</html>
