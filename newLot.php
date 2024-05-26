<?php 
session_start();
if(isset($_SESSION['user'])){
    $username = $_SESSION['user']['name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("links/headLinks.php"); ?>
</head>

<body>
    <!-- create folders  -->
    <?php
        // Directory path for user's folder
        $uploadsSellFolderPath = "uploads/sell/";
        $userFolderPath = $uploadsSellFolderPath . $username . '/';

        // Open the uploads/sell directory
        $handle = opendir($uploadsSellFolderPath);

        // Check if the directory was opened successfully
        if ($handle !== false) {
            $userFolderExists = false;

            // Loop through the directory contents
            while (false !== ($entry = readdir($handle))) {
                // Check if the entry is a directory and matches the username
                if (is_dir($uploadsSellFolderPath . $entry) && $entry === $username) {
                    $userFolderExists = true;
                    break;
                }
            }

            // Close the directory handle
            closedir($handle);

            // If user folder doesn't exist, create it
            if (!$userFolderExists) {
                if (!mkdir($userFolderPath, 0777, true)) {
                    // Handle folder creation failure (optional)
                    echo "<script>alert('Failed to create user folder.');</script>";
                    echo "<script>";
                    echo 'swal("Failed to create user folder.", "", "");';
                    echo "  setTimeout(
                        function() { window.location.href = 'sell.php'; }, 1500
                    );";
                    echo  "</script>";
                } else {
                    echo "<script>";
                    echo 'swal("Insert First product details .", "", "");';
                    echo  "</script>";
                }
            } else {
                echo "<script>";
                echo 'swal("Insert product details . ", "", "");';
                echo  "</script>";
            }
        } else {
            // Handle directory opening failure
            echo "<script>";
            echo 'swal("Failed to open directory.", "", "");';
            echo "  setTimeout(
                function() { window.location.href = 'sell.php'; }, 1500
            );";
            echo  "</script>";
        }
    ?>

    <!-- nav bar -->
    <?php include("links/nav.php")?>

    <!-- ======= Intro Single ======= -->
    <section class="intro-single mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="title-single-box">
                        <h1 class="title-single"><?php echo $_SESSION['user']['name'] ?></h1>
                    </div>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="userPanel.php">Panel</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="sell.php">Sell</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                New lot +
                            </li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Single-->

    <!-- input section -->
    <div class="pruduct-inputs container">
        <div class="inputs">
            <form class="row g-3 pruducts-form " action="backend/saveLot.php" method="post"
                enctype="multipart/form-data">
                <div class="col-12">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="<?php echo isset($_SESSION['formData']) ? $_SESSION['formData']['title'] : ''; ?>"
                        required>
                </div>
                <div class="col-12">
                    <label for="reservePrice" class="form-label">Reserve Price</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">LKR</span>
                        <input type="number" class="form-control" name="reservePrice" id="reservePrice"
                            value="<?php echo isset($_SESSION['formData']) ? $_SESSION['formData']['reservePrice'] : ''; ?>"
                            required>
                    </div>
                </div>
                <!-- Other form fields -->
                <!-- Condition -->
                <div class="col-md-6">
                    <label for="condition" class="form-label">Condition</label>
                    <select id="condition" name="condition" class="form-select" required>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['condition'] == 'Choose...' ? 'selected' : ''; ?>>
                            Choose...</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['condition'] == 'new' ? 'selected' : ''; ?>
                            value="new">New</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['condition'] == 'used' ? 'selected' : ''; ?>
                            value="used">Used</option>
                    </select>
                </div>
                <!-- Delivery Type -->
                <div class="col-md-6">
                    <label for="deloveryType" class="form-label">Delivery Type</label>
                    <select id="deloveryType" name="deliveryType" class="form-select" required>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['deliveryType'] == 'Choose...' ? 'selected' : ''; ?>>
                            Choose...</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['deliveryType'] == 'collection' ? 'selected' : ''; ?>
                            value="collection">Collection</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['deliveryType'] == 'delivery' ? 'selected' : ''; ?>
                            value="delivery">Delivery</option>
                    </select>
                </div>
                <!-- Category -->
                <div class="col-6">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-select" required>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData'] == 'Please select the auction category...' ? 'selected' : ''; ?>>
                            Please select the auction category...</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['category'] == 'electronics' ? 'selected' : ''; ?>
                            value="electronics">Electronics</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['category'] == 'fashion' ? 'selected' : ''; ?>
                            value="fashion">Fashion</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['category'] == 'wares' ? 'selected' : ''; ?>
                            value="wares">Wares</option>
                        <option
                            <?php echo isset($_SESSION['formData']) && $_SESSION['formData']['category'] == 'arts' ? 'selected' : ''; ?>
                            value="arts">Arts</option>
                    </select>
                </div>
                <!-- Days -->
                <div class="col-6">
                <label for="reservePrice" class="form-label">how many days</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">days</span>
                        <input type="number" class="form-control" name="days" id="days"
                            value="<?php echo isset($_SESSION['formData']) ? $_SESSION['formData']['days'] : ''; ?>"
                            required>
                    </div>
                </div>
                <!-- City -->
                <div class="col-md-6">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="<?php echo isset($_SESSION['formData']) ? $_SESSION['formData']['city'] : ''; ?>"
                        required>
                </div>
                <!-- Area -->
                <div class="col-md-4">
                    <label for="area" class="form-label">Area</label>
                    <input type="text" class="form-control" id="area" name="area"
                        value="<?php echo isset($_SESSION['formData']) ? $_SESSION['formData']['area'] : ''; ?>"
                        required>
                </div>
                <div class="col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"
                        required><?php echo isset($_SESSION['formData']) ? $_SESSION['formData']['description'] : ''; ?></textarea>
                </div>
                <div class="col-md-12">
                    <label for="imgMultiple" class="form-label">Multiple files input example (insert all views of
                        product)</label>
                        <div class="row">
                            <div class="col-md-4">
                                <input class="form-control mb-2" type="file" id="productImage1" name="productImage1" required
                            onchange="previewImage1(this)">
                            <img id="imagePreview1" src="default-product-image.png" alt="Image Preview"
                        style="max-width: 200px;">
                            </div>
                            <div class="col-md-4">
                            <input class="form-control mb-2" type="file" id="productImage2" name="productImage2"  required
                            onchange="previewImage2(this)">
                            <img id="imagePreview2" src="default-product-image.png" alt="Image Preview"
                        style="max-width: 200px;">
                            </div>
                            <div class="col-md-4">
                            <input class="form-control mb-2" type="file" id="productImage3" name="productImage3"  required
                            onchange="previewImage3(this)">
                            <img id="imagePreview3" src="default-product-image.png" alt="Image Preview"
                        style="max-width: 200px;">
                            </div>
                        </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success">Make Request</button>
                    <button type="" class="btn btn-outline-success">Cancel</button>
                </div>
            </form>
        </div>
    </div>


    <?php include("links/footerLinks.php")?>
    <script>
        function previewImage1(input) {
            var preview = document.getElementById('imagePreview1');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }

        function previewImage2(input) {
            var preview = document.getElementById('imagePreview2');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }

        function previewImage3(input) {
            var preview = document.getElementById('imagePreview3');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
    <script src="assets/js/saveLot.js"></script>
</body>

</html>

<?php
}
else{
    header('location:account.php');
}
?>