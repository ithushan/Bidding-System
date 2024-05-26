<?php 
session_start();
if (isset($_SESSION['user'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include("links/headLinks.php");
        $buyer_id = $_SESSION['user']['id'];
    ?>
</head>
<body>
    <!-- ======= Intro Single ======= -->
    <section class="intro-single">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="title-single-box">
                        <h1 class="title-single">Bidding Details</h1>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4">
                    <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="userPanel.php">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Bidding Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Intro Single-->

    <!-- Button for won bids -->
    <div class="container">
        <div class="row">
            <div class="col">
                <button class="btn btn-success">Won Bids</button>
            </div>
        </div>
    </div>

    <!-- Fetch data from table -->
    <?php
        include('backend/conn.php');
        $sql_auctionUser = "
            SELECT au.id AS auction_user_id, au.price AS bid_price, au.date AS bid_date,
                   ap.product_id, ap.price AS last_bid_price, ap.status, ap.end_date,
                   p.title, p.reserve_price, p.seller_id
            FROM auction_users au
            JOIN (
                SELECT buyer_id, auction_id, MAX(price) as max_price
                FROM auction_users
                WHERE buyer_id = $buyer_id
                GROUP BY buyer_id, auction_id
            ) as max_prices
            ON au.buyer_id = max_prices.buyer_id
            AND au.auction_id = max_prices.auction_id
            AND au.price = max_prices.max_price
            JOIN auctionproducts ap ON au.auction_id = ap.auction_id
            JOIN products p ON ap.product_id = p.product_id
            WHERE au.buyer_id = $buyer_id
            ORDER BY au.buyer_id, au.auction_id, au.price
        ";
        
        $result_auctionUser = mysqli_query($conn, $sql_auctionUser);

        // Check if the query was successful
        if ($result_auctionUser) { ?>

            <div class="container">
                <div class="table-responsive">
                    <h3>Current bids</h3>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Product Image</th>
                                <th scope="col">Reserve Price</th>
                                <th scope="col">My Bid Amount</th>
                                <th scope="col">Last Bid Amount</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
        <?php
            // Fetch the results as an associative array
            while ($row_auctionUser = mysqli_fetch_assoc($result_auctionUser)) {
                echo '<tr>';
                $imageDirectory = 'uploads/sell/' . $row_auctionUser['seller_id'] . '/' . $row_auctionUser['title'] . '/';
                $imagePattern = $imageDirectory . 'first_image.*';
                $imageFiles = glob($imagePattern);

                if (!empty($imageFiles)) {
                    $imagePath = $imageFiles[0];
                    echo '<td>
                            <img src="' . $imagePath . '" alt="Product Image" width="100">
                            <br>
                            ' . $row_auctionUser['title'] . '
                        </td>';
                } else {
                    echo '<td>No Image</td>';
                }
                echo '<td>' . $row_auctionUser['reserve_price'] . '</td>';
                echo '<td>' . $row_auctionUser['bid_price'] . ' (' . $row_auctionUser['bid_date'] . ')</td>';
                echo '<td>' . $row_auctionUser['last_bid_price'] . '</td>';
                echo '<td>' . $row_auctionUser['status'] . '<br>' . $row_auctionUser['end_date'] . '</td>';

                $disabledClass = ($row_auctionUser['last_bid_price'] == $row_auctionUser['bid_price']) ? 'disabled' : '';
                echo '<td><a class="btn btn-info ' . $disabledClass . '" href="viewProduct.php?id=' . urlencode($row_auctionUser['product_id']) . '">Bid</a></td>';
                echo '</tr>';
            }
        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    ?>
    <?php include("links/footerLinks.php")?>
</body>
</html>

<?php
} else {
    header('Location: account.php');
    exit();
}
?>
