<div id="bid-form" class="content mt-3 p-5">
    <?php
    include ('backend/conn.php');
    if (isset($_SESSION['product_id'])) {
        $productId = $_SESSION['product_id'];
        $sql = "SELECT products.*,u.Email,u.user_id FROM products LEFT JOIN users as u ON u.user_id = products.seller_id WHERE product_id = $productId ";
        $result = mysqli_query($conn, $sql);

        $sqlForAuctionProducts = "SELECT * FROM auctionproducts WHERE product_id = " . $productId;
        $resultForAuctionProducts = mysqli_query($conn, $sqlForAuctionProducts);
        $rowForAuctionProducts = mysqli_fetch_assoc($resultForAuctionProducts);

        // Check if the query was successful
        if ($result) {
            $row = mysqli_fetch_assoc($result);
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
            <form onsubmit="submitBid(event)">
                <div class="row">
                    <div class="col-md-6">
                        <input type="number" id="amount" class="form-control" name="amount" id="amount">
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
    <script>
        console.log("sdfgsdfg");
        const user_id = "<?php echo $_SESSION['user']['id'] ?>";
        const product_id = "<?php echo $_GET['id'] ?>";
        function submitBid(e) {
            e.preventDefault();
            console.log(e);

            if (!validateBid()) {
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.onload = function (params) {
                const response = JSON.parse(this.responseText);

                if (response?.status) {

                }
                else {
                    console.log('response', response);
                    swal(response?.message, "", "error");
                }
            }
            xhr.open('POST', "/Bidding-System/bidAmount.php", true);
            const data = new FormData();
            const amount = document.getElementById('amount')?.value
            data.append('amount', amount);
            data.append('user_id', user_id);
            data.append('product_id', product_id);
            data.append('user_id', user_id);

            xhr.send(data);
        }
    </script>
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
                swal("The bid amount must be greater than the current price of Rs. " + currentPrice.toFixed(2), "",
                    "error");
                return false;
            } else if (amount > maxBid) {
                swal("The bid amount must be less than or equal to Rs. " + maxBid.toFixed(2), "", "error");
                return false;
            } else if (amount < minBid) {
                swal("The bid amount must be greater than or equal to Rs. " + minBid.toFixed(2), "", "error");
                return false;
            }else{
                swal("The bidding success Rs. " + amount.toFixed(2), "", "success");
                return true;
            }

            // If all checks pass, return true
            // return true;
        }
    </script>
</div>