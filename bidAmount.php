<?php
session_start();

require 'vendor/autoload.php';

    use Pusher\Pusher;
    
    $options = [
        'cluster' => 'ap1',
        'useTLS' => true
    ];
    $pusher = new Pusher(
        '36bd53a61ebe20083542',
        '1373c9a0db8e5e6e2259',
        '1807141',
        $options
    );
    
    // Function to send a notification
   // Function to send a notification
    function sendBidNotification($channel, $event, $data) {
        global $pusher;
        $pusher->trigger($channel, $event, $data);
    }

    // Example usage
    $channel = 'bids';
    $event = 'new-bid';
    $data = [
        'message' => 'A new bid has been placed!',
        'bid_amount' => 100, // Example data
    ];
    sendBidNotification($channel, $event, $data);

if(isset($_SESSION['user'])){
    include('backend/conn.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('links/headLinks.php')?>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php

function insertAuctionUser($conn, $buyer_id, $auction_id, $price) {
    $sql = "INSERT INTO auction_users (buyer_id, auction_id, price) VALUES ('$buyer_id', '$auction_id', '$price')";
    return mysqli_query($conn, $sql);
}

function getProductAuctionId($conn, $productId) {
    $sql = "SELECT auction_id FROM AuctionProducts WHERE product_id = '$productId'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['auction_id'];
    }
    return null;
}

function getProductCurrentPrice($conn, $productId) {
    $sql = "SELECT price FROM AuctionProducts WHERE product_id = '$productId'";
    $result = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['price'];
    }
    return null;
}

function updateProductPrice($conn, $productId, $newPrice) {
    $sql = "UPDATE AuctionProducts SET price = '$newPrice' WHERE product_id = '$productId'";
    return mysqli_query($conn, $sql);
}

// function validateBidAmount($currentPrice, $bidAmount) {
//     return $bidAmount >= $currentPrice + 200;
// }
    function whoBid($product_id, $user_id, $conn) {
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
    $productId = $_SESSION['product_id'];

    $currentPrice = getProductCurrentPrice($conn, $productId);
    echo $productId;
    echo "<br>";
    echo $_SESSION['user']['id'];
    if (whoBid($productId, $_SESSION['user']['id'], $conn)) {
        echo "<script> alert('done !'); </script>";
        if (updateProductPrice($conn, $productId, $bidAmount)) {
            $auctionId = getProductAuctionId($conn, $productId);
            
            if (insertAuctionUser($conn, $_SESSION['user']['id'], $auctionId, $bidAmount)) {
                echo "<script>
                    swal('Bid amount updated successfully.', '', 'success');
                    setTimeout(function() { window.location.href = 'viewProduct.php?id=".$productId."'; }, 1500);
                </script>";
            } else {
                echo "<script>
                    swal('Error inserting auction user.', '', 'error');
                    setTimeout(function() { window.location.href = 'viewProduct.php'; }, 1500);
                </script>";
            }
        } else {
            echo "<script>
                swal('Error updating bid amount.', '', 'error');
                setTimeout(function() { window.location.href = 'viewProduct.php'; }, 1500);
            </script>";
        }
    } else {
        echo "<script>
            swal('Last bid amount is yours !', '', 'error');
            setTimeout(function() { window.location.href = 'viewProduct.php?id=".$productId."'; }, 1500);
        </script>";
    }
}
?>

<?php include('links/footerLinks.php'); ?>

<script>
        var pusher = new Pusher('your_app_key', {
    cluster: 'your_cluster'
    });

    // Subscribe to the channel and bind to the event
    var channel = pusher.subscribe('bids');
    channel.bind('new-bid', function(data) {
    alert(data.message); // Display the notification
    console.log('New bid amount: ' + data.bid_amount);
    });
</script>
</body>
</html>
<?php
} else {
    header('Location: account.php');
}
?>
