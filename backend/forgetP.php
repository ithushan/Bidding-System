<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php 

include("conn.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
    $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";

    // Check in the database
    $sql = "SELECT Name,Email,Password FROM users WHERE Email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Fetch the row from the result set
        echo $email;
        $row = mysqli_fetch_assoc($result);

        // Generate random OTP
        $otp = mt_rand(100000, 999999);
        $name = $row["Name"];
        // Store OTP in session variable
        $_SESSION['otp_info'] = array(
            'name' => $name,
            'email' => $email,
            'otp' => $otp
        );

        // Add code to send OTP to user's email address
        // For example, you can use PHP's mail() function or a third-party email service

        // Redirect user to OTP verification page
        echo "<script>";
        echo 'swal("OTP send your email", "", "success");';
        echo "  setTimeout(
                    function() { window.location.href = 'forgetMail.php'; }, 200
                );";
        echo  "</script>";
        exit;
    } else {
        // Email does not exist in the database
        // Show alert
        echo "<script>";
        echo 'swal("Email is not registered.", "", "error");';
        echo "  setTimeout(
                    function() { window.location.href = '../updateUserDetails.php'; }, 2200
                );";
        echo  "</script>";
    }
}

?>

</body>
</html>