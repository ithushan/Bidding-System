<?php
session_start();
if(isset($_SESSION['admin'])){
include('../backend/conn.php'); // Include the file containing the database connection

if (isset($_SESSION['admin'])) {
    if (isset($_GET['id']) && isset($_GET['source'])) {
        $productId = $_GET['id']; 
        $source = $_GET['source'];

        // Retrieve product details based on the product ID from the database
        $sql = "SELECT * FROM products WHERE product_id = $productId ";
        $result = mysqli_query($conn, $sql); // Execute the query using the database connection

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                // Fetch user details based on the user_id
                $sqlUser = "SELECT * FROM users WHERE user_id = '" . $row['seller_id'] . "'";
                $resultUser = mysqli_query($conn, $sqlUser);

                if ($resultUser && mysqli_num_rows($resultUser) > 0) {
                    $rowUser = mysqli_fetch_assoc($resultUser);
                } else {
                    echo "Error fetching user details: " . mysqli_error($conn);
                }
            } else {
                echo "No product details found for the specified ID.";
            }
        } else {
            echo "Error executing the query: " . mysqli_error($conn);
        }
    } else {
        echo "Product ID or source not specified.";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("components/headlinks.php"); ?>
</head>
<body>
    <?php include("components/nav.php") ?>

    <section class="section-t8 container mt-5">
        <h1>Product Details</h1>
        <?php
        if (isset($row)) {
            echo "<p>Product ID: " . $row['product_id'] . "</p>";
            echo "<h2>Title: " . $row['title'] . "</h2>";
            echo "<p>Price: " . $row['reserve_price'] . "</p>";
            echo "<p>Days: " . $row['days'] . "</p>";
            echo "<p>Description: " . $row['description'] . "</p>";
            $_SESSION['price'] = $row['reserve_price'];

            if (isset($rowUser)) {
                echo "<p>Seller: " . $rowUser['Name'] . "</p>";
                echo "<p>Email: <a href='#'>" . $rowUser['Email'] . "</a></p>";
            }

            $dir = "../uploads/sell/" . $row['seller_id'] . "/" . $row['title'] . "/";
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    echo '<div class="image-container">';
                    while (($file = readdir($dh)) !== false) {
                        if ($file != '.' && $file != '..') {
                            echo '<div>';
                            echo '<img src="' . $dir . $file . '" alt="' . $file . '" style="object-fit: cover; width: 300px; height:300px" class="m-2">';

                            echo '<p>' . $file . '</p>';
                            echo '</div>';
                        }
                    }
                    echo '</div>';
                    closedir($dh);
                }
            }
        }
        ?>

        <form action="../backend/updateProductStatus.php" method="post">
            <input type="hidden" name="productId" value="<?php echo $productId; ?>">
            <div class="d-grid gap-2 d-md-flex">
                <?php
                if ($source === 'request') {
                    echo '<button class="btn btn-outline-danger me-md-2" type="submit" name="reject">Reject</button>';
                    echo '<button class="btn btn-success" type="submit" name="approved">Approved</button>';
                } elseif ($source === 'approved') {
                    echo '<button class="btn btn-outline-danger me-md-2" type="submit" name="reject">Reject</button>';
                } elseif ($source === 'rejected') {
                    echo '<button class="btn btn-success" type="submit" name="approved">Approved</button>';
                }
                ?>
            </div>
        </form>
    </section>

    <?php include("components/footerLinks.php") ?>
</body>
</html>
<?php
} else {
    echo "<script>";
    echo 'swal("Failed to access. Please try again later.", "", "error");';
    echo "setTimeout(function() { window.location.href = 'account.php'; }, 1000);";
    echo "</script>";
}
?>
<?php
}else{
     header("location:../account.php");
}
?>
