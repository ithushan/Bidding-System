<?php
session_start();

if (isset($_SESSION['user'])) {
    include ('backend/conn.php');
    function insertAuctionUser($conn, $buyer_id, $auction_id, $price)
    {
        $sql = "INSERT INTO auction_users (buyer_id, auction_id, price) VALUES ('$buyer_id', '$auction_id', '$price')";
        return mysqli_query($conn, $sql);
    }

    function getProductAuctionId($conn, $productId)
    {
        $sql = "SELECT auction_id FROM AuctionProducts WHERE product_id = '$productId'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['auction_id'];
        }
        return null;
    }

    function getProductCurrentPrice($conn, $productId)
    {
        $sql = "SELECT price FROM AuctionProducts WHERE product_id = '$productId'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['price'];
        }
        return null;
    }

    function updateProductPrice($conn, $productId, $newPrice)
    {
        $sql = "UPDATE AuctionProducts SET price = '$newPrice' WHERE product_id = '$productId'";
        return mysqli_query($conn, $sql);
    }

    // function validateBidAmount($currentPrice, $bidAmount) {
//     return $bidAmount >= $currentPrice + 200;
// }
    function whoBid($product_id, $user_id, $conn)
    {
        $sql = "
            SELECT MAX(au.price) AS max_price, ap.price AS auction_product_price
            FROM auction_users au
            JOIN auctionproducts ap ON au.auction_id = ap.auction_id
            WHERE au.buyer_id = $user_id
            AND ap.product_id = $product_id
        ";

        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $max_price = $row['max_price'];
        $auction_product_price = $row['auction_product_price'];

        $auction_product_price = intval($auction_product_price);
        if ($max_price == $auction_product_price) {
            return false;
        }
        return true;
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bidAmount = $_POST['amount'];
        $productId = $_POST['product_id'];
        $user_id = $_POST['user_id'];
        $_SESSION['product_id'] = $productId;

        $currentPrice = getProductCurrentPrice($conn, $productId);
        // echo $productId;
        // echo "<br>";
        // echo $_SESSION['user']['id'];
        if (whoBid($productId, $user_id, $conn)) {
            if (updateProductPrice($conn, $productId, $bidAmount)) {
                $auctionId = getProductAuctionId($conn, $productId);

                if (insertAuctionUser($conn, $user_id, $auctionId, $bidAmount)) {
                    ob_start();
                    include ('bid-form.php');
                    $bidForm = ob_get_contents();
                    ob_end_clean();
                    echo json_encode(
                        array(
                            "status" => true,
                            "message" => "Bid amount updated successfully.",
                            "div" => $bidForm
                        )
                    );
                } else {
                    echo json_encode(
                        array(
                            "status" => false,
                            "message" => "Error inserting auction user."
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        "status" => false,
                        "message" => "Error updating bid amount."
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    "status" => false,
                    "message" => "Last bid amount is yours !"
                )
            );
        }
    }
} else {
    header('Location: account.php');
}
?>