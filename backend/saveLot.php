<?php 
session_start();
include("conn.php");

function resizeImage($imagePath, $width, $height){
    // Get new dimensions
    list($origWidth, $origHeight) = getimagesize($imagePath);
    $ratio = $origWidth / $origHeight;

    if ($width / $height > $ratio) {
        $width = $height * $ratio;
    } else {
        $height = $width / $ratio;
    }

    // Resample
    $image = imagecreatetruecolor($width, $height);
    $imageType = exif_imagetype($imagePath);

    switch ($imageType) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($imagePath);
            break;
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($imagePath);
            break;
        case IMAGETYPE_GIF:
            $source = imagecreatefromgif($imagePath);
            break;
        default:
            return false;
    }

    // Resize and save image
    imagecopyresampled($image, $source, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
    imagejpeg($image, $imagePath, 100);

    // Free memory
    imagedestroy($image);
    imagedestroy($source);

    return true;
}

if(isset($_SESSION['user'])){
    $id = $_SESSION['user']['id'];
    $username = $_SESSION['user']['name'];
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php

    $check = false;
    $titleCheck = false;
    // Validate form fields
    $title = $_POST['title'];
    $reservePrice = $_POST['reservePrice'];
    $condition = $_POST['condition'];
    $deliveryType = $_POST['deliveryType'];
    $category = $_POST['category'];
    $days = $_POST['days'];
    $city = $_POST['city'];
    $area = $_POST['area'];
    $description = $_POST['description'];

    $formData = array(
        'title' => $_POST['title'],
        'reservePrice' => $_POST['reservePrice'],
        'condition' => $_POST['condition'],
        'deliveryType' => $_POST['deliveryType'],
        'category' => $_POST['category'],
        'days' => $_POST['days'],
        'city' => $_POST['city'],
        'area' => $_POST['area'],
        'description' => $_POST['description']
    );

    // Store the form data array in a session variable
    $_SESSION['formData'] = $formData;

    // Prepare the SQL statement
    $sql_check_title = "SELECT COUNT(title) AS title_count FROM products WHERE title = '$title' AND seller_id = '$id'";
    $result_check_title = mysqli_query($conn, $sql_check_title);

    if ($result_check_title) {
        $row_check_title = mysqli_fetch_assoc($result_check_title);
        $title_count = $row_check_title['title_count'];
        if ($title_count >= 1) {
            // Title is already in use
            $titleCheck = true;
            echo "<script>";
            echo 'swal("Product title is already in use. Please choose another title and again select images", "", "error");';
            echo "setTimeout(function() { window.location.href = '../newLot.php'; }, 2000);";
            echo "</script>";
        }
    }

    if(!$titleCheck){
        $targetDir = "../uploads/sell/" . $id . "/" .  $title . "/";

        // Check if the target directory is writable
        if (!is_writable("../uploads/sell/")) {
            echo "<script>";
            echo 'swal("Uploads directory is not writable. Please check permissions.", "", "error");';
            echo "setTimeout(function() { window.location.href = '../newLot.php'; }, 2000);";
            echo "</script>";
            exit();
        }

        // Create the target directory if it doesn't exist
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                // Log the error for debugging
                error_log("Failed to create directory: $targetDir");
                echo "<script>";
                echo 'swal("Failed to create product folder. Please try again later.", "", "error");';
                echo "setTimeout(function() { window.location.href = '../newLot.php'; }, 2000);";
                echo "</script>";
                exit();
            }
        }

        // Handle image uploads
        $defaultWidth = 400;
        $defaultHeight = 400;

        $uploadedImages = [];
        if (isset($_FILES['productImage1']['name']) && $_FILES['productImage1']['error'] == UPLOAD_ERR_OK) {
            $fileName = $_FILES['productImage1']['name'];
            $targetFilePath = $targetDir . "first_image." . pathinfo($fileName, PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES['productImage1']['tmp_name'], $targetFilePath)) {
                $uploadedImages[] = "first_image." . pathinfo($fileName, PATHINFO_EXTENSION);
                $check = true;
                resizeImage($targetFilePath, $defaultWidth, $defaultHeight);
            }
        }
        if (isset($_FILES['productImage2']['name']) && $_FILES['productImage2']['error'] == UPLOAD_ERR_OK) {
            $fileName = $_FILES['productImage2']['name'];
            $targetFilePath = $targetDir . "second_image." . pathinfo($fileName, PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES['productImage2']['tmp_name'], $targetFilePath)) {
                $uploadedImages[] = "second_image." . pathinfo($fileName, PATHINFO_EXTENSION);
                $check = true;
                resizeImage($targetFilePath, $defaultWidth, $defaultHeight);
            }
        }
        if (isset($_FILES['productImage3']['name']) && $_FILES['productImage3']['error'] == UPLOAD_ERR_OK) {
            $fileName = $_FILES['productImage3']['name'];
            $targetFilePath = $targetDir . "third_image." . pathinfo($fileName, PATHINFO_EXTENSION);
            if (move_uploaded_file($_FILES['productImage3']['tmp_name'], $targetFilePath)) {
                $uploadedImages[] = "third_image." . pathinfo($fileName, PATHINFO_EXTENSION);
                $check = true;
                resizeImage($targetFilePath, $defaultWidth, $defaultHeight);
            }
        }

        if($check){
            $sql = "INSERT INTO products (seller_id, title, reserve_price, currentCondition, delivery_type, category, days, city, area, description)
                    VALUES ('$id', '$title', '$reservePrice', '$condition', '$deliveryType', '$category', '$days', '$city', '$area', '$description')";

            unset($_SESSION['formData']);

            if(mysqli_query($conn, $sql)) {
                // Product insertion successful
                echo "<script>";
                echo 'swal("Product added successfully. Check your email", "", "success");';
                echo "setTimeout(function() { window.location.href = '../sell.php'; }, 2000);";
                echo "</script>";
            } else {
                // Product insertion failed
                error_log("MySQL error: " . mysqli_error($conn)); // Log the error for debugging
                echo "<script>";
                echo 'swal("Failed to add product. Please try again later.", "", "error");';
                echo "setTimeout(function() { window.location.href = '../newLot.php'; }, 2000);";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo 'swal("Failed to add product. Please try again later. No images uploaded.", "", "error");';
            echo "setTimeout(function() { window.location.href = '../newLot.php'; }, 2000);";
            echo "</script>";
        }
    }

?>
</body>

</html>
<?php
    }
} else {
    header('location:../newLot.php');
}
?>
