<?php
session_start();

if (isset($_POST['delete'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin') {
        $imagePath = $_POST['image_path'];
        $imageFilename = $_POST['image_filename'];

        // Here, implement your logic to delete the specific image using $imagePath or $imageFilename
        
        // Example deletion code (you need to replace this with your actual deletion logic)
        if (file_exists($imagePath)) {
            unlink($imagePath); // Delete the file
            echo 'Image deleted successfully.';
        } else {
            echo 'Image not found or already deleted.';
        }
    } else {
        echo 'You do not have permission to delete images.';
    }
} else {
    echo 'Invalid request.';
}
?>
