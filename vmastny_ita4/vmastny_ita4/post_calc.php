<?php
if(isset($_FILES["fileToUpload"]["name"])) {
    $target_dir = "assets/images/calc/";
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $image = $_FILES["fileToUpload"]["name"]; 
    
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
    
    if (file_exists($target_file)) {
        echo "Soubor již existuje.";
        $uploadOk = 0;
    }
    
    if ($_FILES["fileToUpload"]["size"] > 2000000000) {
        echo "Soubor je příliš velký.";
        $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Pouze JPG, JPEG, PNG & GIF jsou povolené.";
        $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
        echo "Soubor nebyl nahrán.";
    } else {
     
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
                header("Location: calcu.php");
            } else {
                echo "Chyba při nahrávání souboru do databáze.";
            }
        } else {
            echo "Chyba při nahrávání souboru.";
        }
    }
}
?>
