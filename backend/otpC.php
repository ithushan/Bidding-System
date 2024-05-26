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
    $email = isset($_POST["otp"]) ? htmlspecialchars($_POST["otp"]) : "";

    if(isset($_SESSION["otp_info"])){
        $storedOTP = $_SESSION["otp_info"]["otp"];
        
        if(isset($_POST["otp"]) && $_POST["otp"] == $storedOTP){
            // OTP is correct, redirect to password changing panel
            echo "<script>";
            echo 'swal("OTP is correct .", "", "success");';
            echo "  setTimeout(
                    function() { window.location.href = '../changePassword.php'; }, 2200
                );";
            echo  "</script>";
            exit;
        } else {
            // OTP is incorrect, show alert and redirect back to forgetPassword.php
            echo "<script>";
            echo 'swal("Incorrect OTP. Please try again.", "", "error");';
            echo "  setTimeout(
                        function() { window.location.href = '../otpCheck.php'; }, 2200
                    );";
            echo  "</script>";
            exit;
        }
    } else {
        // OTP session variable not set, handle the case accordingly
        echo "<script>alert('post method is not work');</script>";
    }
}
else{
    echo "<script>alert('post method is not work');</script>";
}
?>

</body>
</html>