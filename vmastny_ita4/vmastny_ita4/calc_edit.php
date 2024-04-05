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
 

    $stmt = $conn->prepare("UPDATE calc SET title = :title, price = :price WHERE id = :id");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['calc_result'] = "Post successfully updated.";
    } else {
        $_SESSION['calc_result'] = "Error updating post.";
    }

    
    header("Location: calcu.php");
    exit();
}


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
  <link rel="stylesheet" href="assets/styles/blog.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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





    <?php if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin'): ?>
<div class="container-calc"> 
    <div class="form-box">
        <form id="contactForm" action="" method="POST">
            <input type="hidden" name="id" value="<?= $post['id'] ?>"> 
            <div>
                <label for="title">Název:</label>
                <input type="text" id="title" name="title" value="<?= $post['title'] ?>" required>
            </div>
            <div>
                <label for="price">Cena:</label>
                <input type="number" id="price" name="price" value="<?= $post['price'] ?>" required>
            </div>   
            <button type="submit" name="submit">Uložit změny</button>
        </form>
    </div>
</div>
<?php endif; ?>

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
</body>
<script src="assets/scripts/script.js"></script>
</html>
