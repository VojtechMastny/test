<?php
if(isset($_POST["submit"])) {
    $category = $_POST["category"]; // Get the selected category
    $target_dir = "uploads/" . $category . "/"; // Define the target directory based on the selected category

    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file_category = $target_dir . $file_name;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Function to check if the uploaded file is an image
    function isImageValid($file) {
        return getimagesize($file["tmp_name"]) !== false;
    }

    // Check if image file is an actual image or fake image
    if(isImageValid($_FILES["fileToUpload"])) {
        echo "Soubor je obrázek - " . $_FILES["fileToUpload"]["type"] . ".";
        $uploadOk = 1;
    } else {
        echo "Soubor není obrázek.";
        $uploadOk = 0;
    }

    // Check if file already exists in category directory
    if (file_exists($target_file_category)) {
        echo "Soubor již existuje ve složce kategorie.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Soubor je příliš velký.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Pouze JPG, JPEG, PNG & GIF jsou povolené.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Soubor nebyl nahrán.";
    } else {
        // If everything is ok, try to upload file to category directory
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_category)) {
            echo "Soubor ". htmlspecialchars($file_name) . " byl nahrán do složky kategorie.";
        } else {
            echo "Chyba při nahrávání souboru do složky kategorie.";
        }
    }
}
?>
