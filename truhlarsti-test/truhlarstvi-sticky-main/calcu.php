<?php
session_start();
  require_once 'Database.php';
  $db = new Database();
  $conn = $db->conn;

  $sql = "SELECT id, title, price, image FROM calc";
  $result = $conn->query($sql);
?>

<?php
if (isset($_POST['delete_post'])) {
    $postId = $_POST['id'];

    // Retrieve the filename of the image associated with the post
    $stmt = $conn->prepare("SELECT image FROM calc WHERE id = :id");
    $stmt->bindParam(':id', $postId);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Delete the post from the database
    $stmt = $conn->prepare("DELETE FROM calc WHERE id = :id");
    $stmt->bindParam(':id', $postId);
    if ($stmt->execute()) {
        // Delete the associated image file
        $imagePath = "assets/images/calc" . $post['image'];
        if (file_exists($imagePath)) {
            if (unlink($imagePath)) {
                $_SESSION['calc_result'] = "Post and associated image successfully deleted.";
            } else {
                $_SESSION['calc_result'] = "Error deleting image file.";
            }
        } else {
            $_SESSION['calc_result'] = "Image file not found.";
        }
    } else {
        $_SESSION['calc_result'] = "Error deleting post.";
    }

    // Redirect back to the calculation page
    header("Location: calcu.php");
    exit();
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

<div class="calc">
  <div class="row">
  <?php
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      echo '<div class="col">';
      echo '<div class="pow">';
      echo '<div class="item">';
      echo '<div class="img col-tcenter">';
      echo '<img class="lazy" src="assets/images/'.$row['image'].'">';
      echo '</div>';
      echo '<div class="text">';
      echo '<h3 class="tcenter">'.$row['title'].'</h3>';
      echo '<p>Cena: <strong>'.$row['price'].' Kč</strong></p>';
      if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin') {
        echo '<div class="button-container">';
        echo "<form method='post'>";
        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
        echo "<button type='submit' name='delete_post' >Smazat</button>";
        echo "</form>";
        echo "<a href='calc_edit.php?id=" . $row['id'] . "'><button>Edit</button></a>";
        echo '</div>';
      }
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }
  ?>
  </div>
</div>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin'): ?>
<div class="container-calc"> 
    <div class="form-box">
        <form id="contactForm" action="post_calc.php" method="POST" enctype="multipart/form-data">
            <div>
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div>
                <label for="title">Název:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="message">Cena:</label>
                <input type="number" id="message" name="message" required>
            </div>
            <button type="submit">Odeslat</button>
        </form>
    </div>
</div>
<?php endif; ?>

<footer class="<?php echo ((isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin') || ($calc && $calc->rowCount() > 0)) ? 'footer' : 'footer-2'; ?>">
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
<script src="assets/scripts/script.js"></script>
</body>
<script src="assets/scripts/script.js"></script>
</html>
