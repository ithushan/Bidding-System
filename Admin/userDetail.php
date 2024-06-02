<?php 
session_start();
if(isset($_SESSION['admin'])){
include('../backend/conn.php'); // Include the file containing the database connection

if (isset($_SESSION['admin'])) {
    if (isset($_GET['id'])) { // Only checking for user ID now
        $userId = $_GET['id']; 

        // Fetch user details based on the user_id
        $sqlUser = "SELECT * FROM users WHERE user_id = '$userId'";
        $resultUser = mysqli_query($conn, $sqlUser);

        if ($resultUser && mysqli_num_rows($resultUser) > 0) {
            $rowUser = mysqli_fetch_assoc($resultUser);
        } else {
            echo "Error fetching user details: " . mysqli_error($conn);
        }
    } else {
        echo "User ID not specified.";
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
        <h1>User Details</h1>
        <?php
        if (isset($rowUser)) {
            ?>
            <div class="row">
                <div class="col-md-6">
                    <?php
                             echo "<p>User ID: " . $rowUser['user_id'] . "</p>";
                             echo "<h2>" . $rowUser['Name'] . "</h2>";
                             echo "<p>Email: " . $rowUser['Email'] . "</p>";
                             echo "<p>Address: " . $rowUser['AddressL'] . "</p>"; 
                             echo "<p>Zip code: " . $rowUser['Zipcode'] . "</p>";
                             echo "<p>UserType: " . $rowUser['Usertype'] . "</p>";
                             echo "<p>Nic no: " . $rowUser['NICnumber'] . "</p>";
                             echo "<p>City: " . $rowUser['City'] . "</p>";
                    ?>
                </div>
                <div class="col-md-6">
                    <div class="mt-5">
                    <?php
                        $path = "../backend/".$rowUser['ProfilepicName'];
                        echo '<img src="'.$path.'" alt="user image">';
                    ?>
                    </div>
                    
                </div>
            </div>
            <?php
           
           
        }
        ?>
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
} else {
     header("location:../account.php");
}
?>
