<?php
session_start();
unset($_SESSION['productData']);
if(isset($_POST['productId'])) {
    include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../links/headLinks.php") ?>
</head>
<body>
    <?php
        $productId = $_POST['productId'];
        $price = $_SESSION['price'];

        $sql2 = "SELECT products.*, users.email AS seller_email
            FROM products
            JOIN users ON products.seller_id = users.user_id
            WHERE products.product_id = '$productId'
            ";


        $result = mysqli_query($conn, $sql2);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $productDetailForEmail = array(
                'seller_id' => $row['seller_id'],
                'Title' => $row['title'],
                'days' => $row['days'],
                'Price' => $row['reserve_price'], 
                'email' => $row['seller_email']
            );
        }
        
        
        $start_date = date("Y-m-d"); 
        $days = $productDetailForEmail['days']; 
        $end_date = strtotime("+$days days", strtotime($start_date)); 
        // Now you have the end date in timestamp format, you can convert it to the desired format, e.g., Y-m-d H:i:s
        $end_date_formatted = date('Y-m-d', $end_date);
        echo $start_date;
        echo "<br>";
        echo $end_date;
        echo "<br>";
        echo $end_date_formatted;
        // Check if the 'accept' button was clicked
        if(isset($_POST['approved'])) {
            // Function definitions
            function updateProductStatusApproved($productId, $conn) {
                $sql = "UPDATE products SET admin_approve_status = 'approved' WHERE product_id = '$productId'";
                if(mysqli_query($conn, $sql)) {
                    return true;
                } else {
                    return false;
                }
            }

            function insertDetailsAuctionProducts($productId, $price, $startDate, $endDate , $conn) {
                $sqlForAuctionProducts = "INSERT INTO AuctionProducts (product_id, price, start_date,end_date) VALUES (?, ?, ?, ?)";
                
                // Prepare the statement
                $stmt = mysqli_prepare($conn, $sqlForAuctionProducts);
                if ($stmt) {
                    // Bind the parameters
                    mysqli_stmt_bind_param($stmt, "isss", $productId, $price, $startDate,  $endDate);
                    
                    // Execute the statement
                    if(mysqli_stmt_execute($stmt)) {
                        mysqli_stmt_close($stmt); // Close the statement
                        return true;
                    } else {
                        mysqli_stmt_close($stmt); // Close the statement
                        return false;
                    }
                } else {
                    return false; // Return false if preparing the statement fails
                }
            }

            // email sent user 
            include('approvedModelEmail.php');
            $check = approvedModelEmail($productDetailForEmail['email'],$productDetailForEmail['Title'] );

            if(insertDetailsAuctionProducts($productId, $price, $start_date, $end_date_formatted,$conn) && updateProductStatusApproved($productId, $conn)){
                echo "<script>";
                echo 'swal("Product approved and mail sent successfully.", "", "success");';
                echo "setTimeout(function() { window.location.href = '../Admin/requestProducts.php'; }, 1500);";
                echo "</script>";
            }
            else{
                echo "<script>";
                echo 'swal("Mail could not be sent. Please try again later.", "", "error");';
                echo "setTimeout(function() { window.location.href = '../Admin/requestProducts.php'; }, 1500);";
                echo "</script>";
            }

            exit();
        }
        // Check if the 'reject' button was clicked
        elseif(isset($_POST['reject'])) {
            // Function definitions
            function updateProductStatusReject($productId, $conn) {
                $sql = "UPDATE products SET admin_approve_status = 'rejected' WHERE product_id = '$productId'";
                if(mysqli_query($conn, $sql)) {
                    return true;
                } else {
                    return false;
                }
            }

            include('rejectedModelEmail.php');
            $checkR = rejectedModelEmail($productDetailForEmail['seller_id'],$productDetailForEmail['Title'] );

            if(updateProductStatusReject($productId, $conn) && $checkR){
                echo "<script>";
                echo 'swal("Product rejected and mail sent successfully.", "", "success");';
                echo "setTimeout(function() { window.location.href = '../Admin/requestProducts.php'; }, 1500);";
                echo "</script>";
            }
            else{
                echo "<script>";
                echo 'swal("Mail could not be sent. Please try again later.", "", "error");';
                echo "setTimeout(function() { window.location.href = '../Admin/requestProducts.php'; }, 1500);";
                echo "</script>";
            }
            exit();
        }
    ?>

    <?php include("../links/footerLinks.php"); ?>
</body>
</html>
<?php
} else {
    // If the form submission was invalid, redirect to productDetails.php
    header("Location: productDetails.php?id=".$_POST['productId']);
    exit();
}
?>
