<?php
if ($_SESSION["REQUEST_METHOD"] == "POST") {
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
        echo "Vaše zpráva byla úspěšně odeslána.";
    } else {
        echo "Při odesílání zprávy došlo k chybě. Zkuste to prosím znovu.";
    }
} else {
    // If the request method is not POST, redirect back to the contact page
    header("Location: kontakty.php");
    exit;
}
?>