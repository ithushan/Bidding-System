<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('links/headLinks.php'); ?>
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
        <?php
            include('backend/conn.php');
            if(isset($_GET['id'])){
                $productId = $_GET['id']; 
                $_SESSION['product_id'] = $productId;
                $sql = "SELECT products.*,u.Email,u.user_id FROM products LEFT JOIN users as u ON u.user_id = products.seller_id WHERE product_id = $productId ";
                $result = mysqli_query($conn, $sql);

                $sqlForAuctionProducts = "SELECT * FROM auctionproducts WHERE product_id = " . $productId;
                $resultForAuctionProducts = mysqli_query($conn, $sqlForAuctionProducts);
                $rowForAuctionProducts = mysqli_fetch_assoc($resultForAuctionProducts);
                
                // Check if the query was successful
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo json_encode($row);
                    
                } else {
                    echo "Error executing the query: " . mysqli_error($conn);
                }
            }
        ?>
        <?php
        // if(isset($row)) {
        ?>
        <div class="row">
        <div class="col-md-6">
        <?php
            // Display the product details
            echo "<h2>Title : " . $row['title'] . "</h2>";
            echo "<p>Description : " . $row['description'] . "</p>";
            echo "<p>Delivery Type : " . $row['delivery_type'] . "</p>";
            echo "<p>Address : " . $row['city'] . " , ".$row['area']."</p>";
            echo "<p>Current condition : " . $row['currentCondition'] . "</p>";
            echo "<p>Product Owner : " . $row['Email'] . "</p>";
        ?>
        </div>
        <div class="col-md-6 ">
            <div class="content mt-3 p-5">
                <?php

                include("Product.php"); 

                $productObj = new Product($conn); 
                $remainingDays = $productObj->calculateRemainingDays($rowForAuctionProducts['end_date']);

                echo "<p>Starting Price : " . $row['reserve_price'] . "</p>";
                echo "<h5>Price : " . $rowForAuctionProducts['price'] . "</h5>";
                echo '<p class="badge fs-6 text-bg-success">'.$remainingDays .'</p>';
                if(isset($_SESSION['user']) && $_SESSION['user'] !== null) {
                    // The user session is set, so you can access its elements safely
                    if($_SESSION['user']['id'] == $row['user_id']) {
                        echo  "<p>Last Bid Amount ". $rowForAuctionProducts['price']. "</p>";
                    } else {
                        // The user is not the owner, so display the bid form
                        ?>
                        <p>Bid your amount</p>
                        <form action="bidAmount.php" method="post" onsubmit="return validateBid()">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="amount" id="amount">
                                </div>
                                <div class="col-md-6">
                                    <input type="submit" class="btn btn-success" value="Bid">
                                </div>
                            </div>
                        </form>
                        <?php
                    }
                } else {
                    echo "<script>";
                    echo 'swal("Sign-in your account ", "", "");';
                    echo "setTimeout(function() { window.location.href = 'account.php'; }, 1000);";
                    echo "</script>";
                    exit();
                }
                ?>
            </div>
        </div>
        </div>
        
        
        <h3 class="mt-3 text-center">images</h3>
        <div class="row mt-4">
        <?php 
            $dir = "uploads/sell/" . $row['seller_id'] . "/" . $row['title'] . "/";
            if (is_dir($dir)){
                if ($dh = opendir($dir)){
                    echo '<div class="image-container">';
                    while (($file = readdir($dh)) !== false){
                        if($file != '.' && $file != '..') {
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
    <?php include("links/footerLinks.php")?>

    <script>
        function validateBid() {
            // Get the bid amount entered by the user
            var amount = parseFloat(document.getElementById("amount").value);

            // Get the product's current price from the PHP variable
            var currentPrice = <?php echo $rowForAuctionProducts['price']; ?>;

            // Calculate the maximum allowed bid amount
            var maxBid = currentPrice + (currentPrice * 35 / 100);
            var minBid = currentPrice + (currentPrice * 2 / 100);

            // Check if the bid amount is valid
            if (isNaN(amount)) {
                swal("Please enter a valid bid amount.", "", "error");
                return false;
            } else if (amount <= currentPrice) {
                swal("The bid amount must be greater than the current price of Rs. " + currentPrice.toFixed(2), "", "error");
                return false;
            } else if (amount > maxBid) {
                swal("The bid amount must be less than or equal to Rs. " + maxBid.toFixed(2), "", "error");
                return false;
            }else if (amount < minBid) {
                swal("The bid amount must be greater than or equal to Rs. " + minBid.toFixed(2), "", "error");
                return false;
            }

            // If all checks pass, return true
            return true;
        }
    </script>
</body>
</html>
