<?php
// Include database connection
include("conn.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $userType = $_POST['userType'];
    $address = $_POST['address01'] . ", " . $_POST['address02'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    // Check if the NIC number or email already exists in the database
    $nicCheckQuery = "SELECT * FROM users WHERE NICnumber = '$nic'";
    $emailCheckQuery = "SELECT * FROM users WHERE Email = '$email'";
    $nicResult = mysqli_query($conn, $nicCheckQuery);
    $emailResult = mysqli_query($conn, $emailCheckQuery);

    if (mysqli_num_rows($nicResult) > 0) {
        // NIC number already exists
        echo "<script>";
        echo "alert('NIC number already exists. Please use a different NIC number.');";
        echo "setTimeout(function() {
            window.location.href = '../account.php';
        }, 1000);";
        echo "</script>";
    } elseif (mysqli_num_rows($emailResult) > 0) {
        // Email already exists
        echo "<script>";
        echo "alert('Email already exists. Please use a different email address.');";
        echo "setTimeout(function() {
            window.location.href = '../account.php';
        }, 1000);";
        echo "</script>";
    } else {
        // File upload handling for profile picture
        $targetDir = "uploads/"; // Directory where uploaded files will be stored
        $targetFilePath = $targetDir . basename($_FILES["profilepic"]["name"]);
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profilepic"]["tmp_name"]);
        if ($check !== false) {
            // Allow certain file formats
            if (in_array($fileType, array("jpg", "JPG", "jpeg", "JPEG", "png", "PNG"))) {
                // Upload file to server
                if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $targetFilePath)) {
                    // Resize image to default size (e.g., 300x300)
                    $defaultWidth = 300;
                    $defaultHeight = 250;
                    resizeImage($targetFilePath, $defaultWidth, $defaultHeight);

                    // Insert user data into database
                    $sql = "INSERT INTO users (Name, Email, Password, AddressL, City, Zipcode, ProfilepicName, Usertype, Status, NICnumber) 
                            VALUES ('$name', '$email', '$password', '$address', '$city', '$zip', '$targetFilePath', '$userType', '1', '$nic')";
                    if (mysqli_query($conn, $sql)) {
                        session_start();
                        $_SESSION["EmailID"] = $email;
                        $_SESSION["name"] = $name;
                        echo "<script>";
                        echo "alert('User registered successfully.');";
                        echo "setTimeout(function() {
                            window.location.href = 'mail.php';
                        }, 500);";
                        echo "</script>";
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "<script>";
                    echo "alert('Failed to upload profile picture.');";
                    echo "setTimeout(function() {
                        window.location.href = '../account.php';
                    }, 1000);";
                    echo "</script>";
                }
            } else {
                echo "<script>";
                echo "alert('Invalid file format. Only JPG, JPEG, and PNG files are allowed.');";
                echo "setTimeout(function() {
                    window.location.href = '../account.php';
                }, 1000);";
                echo "</script>";
            }
        } else {
            echo "<script>";
            echo "alert('File is not an image.');";
            echo "setTimeout(function() {
                window.location.href = '../account.php';
            }, 1000);";
            echo "</script>";
        }
    }
}

// Function to resize image
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
    }

    // Resize and save image
    imagecopyresampled($image, $source, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
    imagejpeg($image, $imagePath, 100);

    // Free memory
    imagedestroy($image);
    imagedestroy($source);
}
?>
