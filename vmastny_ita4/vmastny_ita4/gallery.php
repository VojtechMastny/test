<html lang="cs">
<?php
session_start();
require_once 'Database.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="assets/styles/gallery.css">
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
    
<section class="gallery">
    <div class="galerie">
        <div class="row">
            <form action="" method="get">
                <div class="gallery-filter">
            
                    <button type="submit" name="category" value="door">dveře</button>
                    <button type="submit" name="category" value="kitchen">kuchyně</button>
                    <button type="submit" name="category" value="wall">obývací stěny</button>
                    <button type="submit" name="category" value="pergo">pergoly, altány</button>
                    <button type="submit" name="category" value="bed">postele</button>
                    <button type="submit" name="category" value="stairs">schodiště</button>
                    <button type="submit" name="category" value="watch">skříně/skříňky</button>
                </div>
                
            </form>
        </div>
        <div class="row">
            <?php include "category.php"; ?>
        </div>
    </div>
</section>

<button id="scrollTopBtn" class="scroll-top-btn"><i class="fa fa-arrow-up"></i></button>

<?php if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin'): ?>
    <div class="container-gallery"> 
    <div class="form-box">
        <form id="contactForm" action="post.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="title">Soubor:</label>   
                <input type="file" name="fileToUpload" id="fileToUpload">
            </div>
            <div>
                <label for="category">Kategorie:</label>
                <select id="category" name="category">
                  
                    <option value="dvere">dveře</option>
                    <option value="kuchyne">kuchyně</option>
                    <option value="obyvaci_steny">obývací stěny</option>
                    <option value="pergoly_altany">pergoly, altány</option>
                    <option value="postele">postele</option>
                    <option value="schodiste">schodiště</option>
                    <option value="skrine_skrinky">skříně/skříňky</option>
                </select>
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
                        <li><a href="index.php">Domů</a></li>
                        <li><a href="gallery.php">Galerie</a></li>
                        <li><a href="blog.php">Blog</a></li>
                        <li><a href="kontakty.html">Kontakty</a></li>

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