<?php
if(isset($_SESSION['user']) || isset($_SESSION['admin'])){
    include('conn.php');

    // Check if the current page is the user page or the admin page
    $currentPage = basename($_SERVER['PHP_SELF']); // Get the current page filename
    
    if ($currentPage === 'sell.php') {
        $sql = "SELECT * FROM products WHERE seller_id = '" . $_SESSION['user']['id'] . "'";
    } elseif ($currentPage === 'requestProducts.php') {
        $sql = "SELECT * FROM products WHERE admin_approve_status = 'pending' "; 
    } elseif ($currentPage === 'approvedProducts.php') {
        $sql = "SELECT * FROM products WHERE admin_approve_status = 'approved' "; 
    }elseif ($currentPage === 'rejectedProducts.php') {
        $sql = "SELECT * FROM products WHERE admin_approve_status = 'rejected' "; 
    }
    else {
        $sql = ""; 
    }

    
    $result = mysqli_query($conn, $sql);
    
    $productData = array(); // Initialize an array to store product data
    
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
            // Add each row to the product data array
            $productData[] = $row;
        }
    
        // Store the product data array in a session variable
        $_SESSION['productData'] = $productData;
    } else {
        echo "Lots details not found in your account";
    }
}else{
    // echo "<script>";
    // echo 'swal("Failed to add product. Please try again later.", "", "error");';
    // echo "setTimeout(function() { window.location.href = '../userPanel.php'; }, 1000);";
    // echo "</script>";
    header("location: ../userPanel.php");
}


?>
