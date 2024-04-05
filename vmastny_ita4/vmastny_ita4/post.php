<?php
if(isset($_POST["submit"])) {
    $category = $_POST["category"]; 
    $target_dir = "uploads/" . $category . "/"; 

    
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file_category = $target_dir . $file_name;

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

   
    function isImageValid($file) {
        return getimagesize($file["tmp_name"]) !== false;
    }

   
    if(isImageValid($_FILES["fileToUpload"])) {
        echo "Soubor je obrázek - " . $_FILES["fileToUpload"]["type"] . ".";
        $uploadOk = 1;
    } else {
        echo "Soubor není obrázek.";
        $uploadOk = 0;
    }

  
    if (file_exists($target_file_category)) {
        echo "Soubor již existuje ve složce kategorie.";
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 2000000000) {
        echo "Soubor je příliš velký.";
        $uploadOk = 0;
    }

    
    $allowedFormats = array("jpg", "png", "jpeg", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Pouze JPG, JPEG, PNG & GIF jsou povolené.";
        $uploadOk = 0;
    }

 
    if ($uploadOk == 0) {
        echo "Soubor nebyl nahrán.";
    } else {
        
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file_category)) {
            header("Location: gallery.php");
        } else {
            echo "Chyba při nahrávání souboru do složky kategorie.";
        }
    }
}
?>
