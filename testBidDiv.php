<!DOCTYPE html>
<html lang="en">

<head>
    <?php include ('links/headLinks.php'); ?>
</head>

<body>
    <div class="col-md-6 ">
        <div class="content mt-3 p-5">
            <?php
            include ('backend/conn.php');
            if (isset($_GET['id'])) {
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
            include ("Product.php");
            $productObj = new Product($conn);
            $remainingDays = $productObj->calculateRemainingDays($rowForAuctionProducts['end_date']);

            echo "<p>Starting Price : " . $row['reserve_price'] . "</p>";
            echo "<h5>Price : " . $rowForAuctionProducts['price'] . "</h5>";
            echo '<p class="badge fs-6 text-bg-success">' . $remainingDays . '</p>';
            if (isset($_SESSION['user']) && $_SESSION['user'] !== null) {
                // The user session is set, so you can access its elements safely
                if ($_SESSION['user']['id'] == $row['user_id']) {
                    echo "<p>Last Bid Amount " . $rowForAuctionProducts['price'] . "</p>";
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
    <button type="button" onclick="submitBid()">Submit</button>
    <script>
        console.log("sdfgsdfg");
        const user_id = "<?php echo $_SESSION['user']['id'] ?>";
        const product_id = "<?php echo $_GET['id'] ?>";
        const baseURL = "<?php echo $_SERVER['PHP_SELF'] ?>";

        console.log(baseURL);

        function submitBid() {
            const xhr = new XMLHttpRequest();
            xhr.onload = function (params) {
                console.log(this.responseText);
            }
            xhr.open('POST', "/Bidding-System/bidAmount.php", true);
            const data = new FormData();
            data.append('amount',130000);
            data.append('user_id',user_id);
            data.append('product_id',product_id);
            data.append('user_id',user_id);
            
            xhr.send(data);
        }
    </script>
</body>

</html>