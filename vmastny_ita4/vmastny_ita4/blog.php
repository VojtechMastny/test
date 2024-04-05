<?php
session_start();
require_once 'Database.php';

$db = new Database();
$stmt = $db->conn->prepare("SELECT * FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll();

?>

<?php
if(isset($_POST['delete_post'])) {
    
    require_once 'Database.php';

   
    $post_id = $_POST['id'];

   
    $stmt = $db->conn->prepare("DELETE FROM blog WHERE id = :id");

    
    $stmt->bindParam(':id', $post_id);


    if($stmt->execute()) {
        
        header("Location: blog.php");
        exit();
    } else {
      
        echo "Error deleting post.";
    }
}
?>


<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/blog.css">
    <link rel="stylesheet" href="assets/styles/scroll.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

<button id="scrollTopBtn" class="scroll-top-btn"><i class="fa fa-arrow-up"></i></button>


<div id="result" class="result">
    <?php
  
    $conn = $db->conn;

    $sql = "SELECT id, title, content, category_id, date FROM blog ORDER BY date DESC";
    $result = $conn->query($sql);

    if ($result && $result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='result-box'>";
            echo "<div class='title-bg'><h2>" . $row["title"] . "</h2></div>";
            echo "<p>" . $row["content"] . "</p>";

         
            $categoryDisplayName = '';
            foreach ($categories as $category) {
                if ($category['id'] == $row['category_id']) {
                    $categoryDisplayName = $category['display_name'];
                    break;
                }
            }

            echo "<p><strong> Kategorie: </strong>" . $categoryDisplayName . "</p>";
            echo "<p><strong> Datum: </strong>" . $row["date"] . "</p>";

        
            if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin') {
                echo "<form method='post'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='delete_post'>Smazat</button>";
                
               
                echo "</form>";
                echo "<a href='edit_post.php?id=" . $row['id'] . "'><button>Edit</button></a>";
            }
            echo "</div>";
        }
    } else {
         echo "<div class='no-news-container'><h3>Zatím tu nejsou žádné příspěvky</h3></div>";
    }
    ?>
</div>





<?php if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin'): ?>
    <div class="container-blog"> 
        <div class="form-box">
            <form id="contactForm" action="comp.php" method="POST">
                <div>
                    <label for="title">Nadpis:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div>
                    <label for="message">Zpráva:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <div>
                    <label for="category">Kategorie:</label>
                    <select id="category" name="category">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category['id'] ?>"><?= $category['display_name'] ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit">Odeslat</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['blog_result'])): ?>
    <?= htmlspecialchars($_SESSION['blog_result']); ?>
    <?php unset($_SESSION['blog_result']); ?>
<?php endif; ?>


<footer class="<?php echo (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin' && $result->rowCount() > 0) ? 'footer' : 'footer-2'; ?>">
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