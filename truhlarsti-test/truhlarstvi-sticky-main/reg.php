<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/styles/login.css">
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
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
                        <a href="#" class="nav-link">Galerie</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="calcu.html" class="nav-link">Kalkulace</a>
                    </li>
                    <li class="nav-item">
                        <a href="kontakty.html" class="nav-link">Kontakty</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Přihlášení</a>
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


    <div class="register">
        <h1>Registrace</h1>
        <form action="register.php" method="post" autocomplete="off">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Jméno" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Heslo" id="password" required>
            <label for="email">
                <i class="fas fa-envelope"></i>
            </label>
            <input type="email" name="email" placeholder="Email" id="email" required>
            <input type="submit" value="Registrovat">

            <a href="login.php" class="reg-link">Již máte účet? Přihlašte se</a>
        </form>
    </div>





    <footer class="footer-2">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <ul>
                        <li><a href="index.html">Domů</a></li>
                        <li><a href="#">Galerie</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="kontakty.html">Kontakty</a></li>

                    </ul>
                    <h4>Stanislav malec</h4>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/scripts/script.js"></script>
</body>

</html>