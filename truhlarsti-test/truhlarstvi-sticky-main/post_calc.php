<?php
if(isset($_FILES["fileToUpload"]["name"])) {
    $target_dir = "assets/images/";
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image = $file_name;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "Soubor je obrázek - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "Soubor není obrázek.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Soubor již existuje.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Soubor je příliš velký.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Pouze JPG, JPEG, PNG & GIF jsou povolené.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Soubor nebyl nahrán.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            require_once 'Database.php';
            $db = new Database();
            $conn = $db->conn;

            $title = $_POST['title'];
            $price = $_POST['message'];

            $sql = "INSERT INTO calc (title, price, image) VALUES (:title, :price, :image)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':image', $image);

            if ($stmt->execute()) {
                echo "Soubor ". htmlspecialchars($file_name) . " byl úspěšně nahrán.";
            } else {
                echo "Chyba při nahrávání souboru do databáze.";
            }
        } else {
            echo "Chyba při nahrávání souboru.";
        }
    }
}
?>