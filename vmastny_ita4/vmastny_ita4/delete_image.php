<?php
session_start();

if (isset($_POST['delete'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin') {
        $imagePath = $_POST['image_path'];
        $imageFilename = $_POST['image_filename'];
        if (file_exists($imagePath)) {
            unlink($imagePath); 
            echo 'Obrázek ostraněn.';
        } else {
            echo 'Obrázek nenalezen nebo už byl odstraněn.';
        }
    } else {
        echo 'Nemáte práva k odstranění obrázků.';
    }
} else {
    echo '.';
}
?>
