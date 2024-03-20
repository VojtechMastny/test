<html lang="cs">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="assets/styles/style.css">
  <link rel="stylesheet" href="assets/styles/contact.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
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
            <a href="login.php" class="nav-link">Login</a>
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

  <div class="info-container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">01 Otín</div>
          <div class="text-two">Otín 6594 </div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">+420 777 614 303</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">standa.malec@seznam.cz</div>
        </div>
      </div>
      <div class="right-side">
        <iframe class="map"
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d5196.880410720489!2d15.907686!3d49.362743!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470d6c4ed17f456f%3A0x4bfa536cf6e40788!2zT3TDrW4gNiwgNTk0IDAxIE90w61uLCDEjGVza28!5e0!3m2!1scs!2sus!4v1702593347290!5m2!1scs!2sus"></iframe>
      </div>
    </div>
  </div>

  <?php


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Set recipient email address
    $to = "mastnyv.04@spst.eu";

    // Set email headers
    $headers = "From: $name <$email>" . "\r\n";
    $headers .= "Reply-To: $email" . "\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8" . "\r\n";

    // Send email
    $success = mail($to, $subject, $message, $headers);

    // Check if email was sent successfully
    if ($success) {
        $_SERVER['email_sent'] = true;
    } else {
        $_SERVER['email_sent'] = false;
    }

    // Redirect back to the same page to prevent form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Check if email was sent successfully
$email_sent = isset($_SESSION['email_sent']) ? $_SESSION['email_sent'] : null;

// Clear the session variable
unset($_SERVER['email_sent']);
?>


<div class="container-contact">
    <h2>Kontaktujte nás</h2>
    <form method="post">
        <label for="name">Jméno:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="subject">Předmět:</label>
        <input type="text" id="subject" name="subject" required>

        <label for="message">Zpráva:</label>
        <textarea id="message" name="message" required></textarea>

        <input type="submit" value="Odeslat">
    </form>
</div>

  <footer class="footer">
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