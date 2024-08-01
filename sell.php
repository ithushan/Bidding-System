<?php 
session_start();
if(isset($_SESSION['user'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("links/headLinks.php"); ?>
    <style>
        @media (max-width: 768px) {
            .table td, .table th {
                padding: 0.5rem;
                font-size: 0.875rem;
            }
            .table img {
                width: 50px; /* smaller image size for mobile */
            }
        }
    </style>
</head>

<body>
    <!-- nav bar -->
    <?php include("links/nav.php")?>

    <!-- ======= Intro Single ======= -->
    <section class="intro-single mt-1">
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
                            <li class="breadcrumb-item active" aria-current="page">
                                Sell
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Single-->

    <!-- card section for sell -->
    <div class="sell-section">
        <div class="container">
            <div class="panel">
                <div class="row p-3 text-center">
                    <div class="col-md-4  panel-cards mb-4 p-3">
                        <a href="#" class="">
                            <h4>Total product solved: <?php echo "0"; ?></h4>
                        </a>
                    </div>
                    <div class="col-md-4  panel-cards mb-4 p-3">
                        <a href="#" class="">
                            <h4>Total earnings: <?php echo "0"; ?></h4>
                        </a>
                    </div>
                    <div class="col-md-4  panel-cards mb-4 p-3">
                        <a href="newLot.php" class="">
                            <h4>New Product</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- table section -->
    <div class="selling-pruduct-details container">
        <!-- lots details -->
        <?php
            include('backend/readProducts.php');
            if(isset($_SESSION['productData'])){
                $productData = $_SESSION['productData'];
        ?>
        <div class="lotsDetails mt-3">
            <div class="row">
                <div class="col-md-6">
                    <h4>Lots Details</h4>
                </div>
                <div class="col-md-6 text-end">
                    <a href="#">See all</a>
                </div>
            </div>
            <!-- table -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">TITLE</th>
                            <th scope="col">RESERVE PRICE</th>
                            <th scope="col">IMAGE</th>
                            <th scope="col">DUE DATE</th>
                            <th scope="col">APPROVE STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($productData as $product): ?>
                            <tr>
                                <td><?php echo $product['title']; ?></td>
                                <td><?php echo $product['reserve_price']; ?></td>
                                <!-- Display image -->
                                <td>
                                    <?php 
                                        $imageDirectory = 'uploads/sell/' . $_SESSION['user']['id'] . '/' . $product['title'] . '/';
                                        $imagePattern = $imageDirectory . 'first_image.*';
                                        $imageFiles = glob($imagePattern);

                                        if (!empty($imageFiles)) {
                                            $imagePath = $imageFiles[0];
                                            echo '<img src="' . $imagePath . '" alt="Product Image" width="100">';
                                        } else {
                                            echo '<p>No image. </p>';
                                            echo $imageDirectory;
                                        }
                                    ?>
                                </td>
                                <!-- You need to replace the placeholders below with the actual due date and approve status -->
                                <td><?php echo $product['created_at']; ?></td>
                                <td><?php echo $product['admin_approve_status']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
            }
        ?>
    </div>

    <?php include("links/footerLinks.php")?>
</body>
</html>

<?php
}
else{
    header('location:account.php');
}
?>
