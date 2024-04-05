<html lang="cs">
<?php
session_start(); 
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/style.css">
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
   

    <div class="logo">
        <img width="100%" src="assets/images/malec 4.1.png" />
    </div>

    <section aria-label="Photos">
        <div class="carousel" data-carousel>
            <ul data-slides>
                <li class="slide" data-active>
                    <img src="assets/images/foto1.2.png" alt="">
                </li>
                <li class="slide">
                    <img src="assets/images/foto2.2.png" >
                </li>
                <li class="slide">
                    <img src="assets/images/foto3.3.png" >
                </li>
                <li class="slide">
                    <img src="assets/images/foto4.4.png" >
                </li>
            </ul>
        </div>
    </section>

    <footer class="footer">
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