<?php
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';
$images = [];

switch ($selectedCategory) {
    case 'door':
        $categoryDir = 'uploads/dvere/';
        break;
    case 'kitchen':
        $categoryDir = 'uploads/kuchyne/';
        break;
    case 'wall':
        $categoryDir = 'uploads/obývací stěny/';
        break;
    case 'pergo':
        $categoryDir = 'uploads/pergoly_altany/';
        break;
    case 'bed':
        $categoryDir = 'uploads/postele/';
        break;
    case 'stairs':
        $categoryDir = 'uploads/schodiste/';
        break;
    case 'watch':
        $categoryDir = 'uploads/skrine_skrinky/';
        break;
    default:
        $categoryDir = ''; 
}

if (!empty($selectedCategory) && is_dir($categoryDir)) {
    $images = glob($categoryDir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
}

foreach ($images as $index => $image) {
    $imageFilename = basename($image);
    echo '<div class="gallery-item">';
    echo '<div class="gallery-item-inner">';
    echo '<img class="enlarge-img" src="' . $image . '" alt="' . $imageFilename . '" onclick="showImage(' . $index . ')">';
    echo '</div>';
    if (isset($_SESSION['loggedin']) && $_SESSION['username'] === 'admin') {
        echo '<div class="delete-button">';
        echo '<form action="delete_image.php" method="POST">';
        echo '<input type="hidden" name="image_path" value="' . $image . '">';
        echo '<input type="hidden" name="image_filename" value="' . $imageFilename . '">';
        echo '<button type="submit" name="delete" class="delete-icon"><i class="fa fa-trash"></i></button>';
        echo '</form>';
        echo '</div>';
    }
    echo '</div>';
}
?>


<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImg">
    <a class="prev" onclick="showPrevious()">&#10094;</a>
    <a class="next" onclick="showNext()">&#10095;</a>
</div>



<style>
   
    .modal {
     display: none;
        position: fixed;
        z-index: 9999;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
        transition: opacity 0.25s ease;
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 90%;
        transition: transform 0.3s ease; 
    }

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 80px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

   
    .enlarge-img:hover {
        cursor: pointer;
    }

    
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 40px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        z-index: 1; 
    }

    
    .prev {
        left: 0;
    }

    .next {
        right: 0;
        
    }

   
    .modal-content:hover .prev,
    .modal-content:hover .next {
        display: block;
    }
</style>





<script>
 
    var modalImg = document.getElementById("modalImg");
    var modalIndex = 0;
    var images = <?php echo json_encode($images); ?>;
    var modalContent = document.querySelector('.modal-content');

    function closeModal() {
        document.getElementById("imageModal").style.display = "none";
    }

    function showImage(index) {
        modalIndex = index;
        modalImg.src = images[index];
        modalContent.style.transform = 'translateX(0%)'; 
        document.getElementById("imageModal").style.display = "block";
    }

    function showNext() {
        modalIndex = (modalIndex + 1) % images.length;
        modalContent.style.transform = 'translateX(-100%)'; 
        setTimeout(function () {
            modalImg.src = images[modalIndex];
            modalContent.style.transform = 'translateX(0%)'; 
        }, 300); 
    }

    function showPrevious() {
        modalIndex = (modalIndex - 1 + images.length) % images.length;
        modalContent.style.transform = 'translateX(100%)'; 
        setTimeout(function () {
            modalImg.src = images[modalIndex];
            modalContent.style.transform = 'translateX(0%)'; 
        }, 300); 
    }
    
</script>
