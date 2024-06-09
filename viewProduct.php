<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('links/headLinks.php'); ?>
</head>

<body>
    <!-- nav bar -->
    <?php include ("links/nav.php") ?>

    <!-- ======= Intro Single ======= -->
    <section class="intro-single mt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Our Auction Products</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="auction.php">Auctions</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Products
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Single-->

    <!-- ======= products Grid ======= -->
    <section class=" container ">
        <div class="row">
            <div class="col-md-6 ">
                <?php
                $productId = $_GET['id'];
                $_SESSION['product_id'] = $productId;
                ?>
                <?php include ("bid-form.php") ?>
            </div>
            <div class="col-md-6">
                <?php
                // Display the product details
                echo "<h2>Title : " . $row['title'] . "</h2>";
                echo "<p>Description : " . $row['description'] . "</p>";
                echo "<p>Delivery Type : " . $row['delivery_type'] . "</p>";
                echo "<p>Address : " . $row['city'] . " , " . $row['area'] . "</p>";
                echo "<p>Current condition : " . $row['currentCondition'] . "</p>";
                echo "<p>Product Owner : " . $row['Email'] . "</p>";
                ?>
            </div>
        </div>


        <h3 class="mt-3 text-center">images</h3>
        <div class="row mt-4">
            <?php
            $dir = "uploads/sell/" . $row['seller_id'] . "/" . $row['title'] . "/";
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    echo '<div class="image-container">';
                    while (($file = readdir($dh)) !== false) {
                        if ($file != '.' && $file != '..') {
                            echo '<div class="col-md-4">';
                            echo '<img src="' . $dir . $file . '" alt="' . $file . ' " style="object-fit: cover;  height: 200px; width:300px">';
                            echo '<p>' . $file . '</p>'; // Display the image name
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                    closedir($dh);
                }
            }
            // }
            ?>
        </div>
    </section>
    <!-- End products Grid Single-->
    <?php include ("links/footerLinks.php") ?>
</body>

</html>