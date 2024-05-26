<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("links/headLinks.php")?>
</head>

<body>
    <!-- nav bar -->
    <?php include("links/nav.php")?>

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
                                Auctions
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Single-->

    
    <!-- ======= products Grid ======= -->
    <section class="property-grid grid">
        <div class="container">
        <div class="row">
        <?php 
            include("backend/conn.php");
            include("Product.php"); // Include the Product class

            $productObj = new Product($conn); // Create an instance of the Product class
            $products = $productObj->getApprovedProducts();

            if (!empty($products)) {
                foreach ($products as $product) {
                    $productObj->renderProductCard($product);
                }
            } else {
                echo "<div class='col-md-12'><p>No approved products found.</p></div>";
            }
        ?>
        </div>


        </div>
    </section>
    <!-- End products Grid Single-->

    <?php include("links/footerSection.php")?>

    <?php include("links/footerLinks.php")?>

</body>
</html>







