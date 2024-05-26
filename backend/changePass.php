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

    $email = $_SESSION["otp_info"]["email"];
    $newPassword = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : "";

    echo $email . " " . $newPassword;
        // Email found, update the password
        $updateSql = "UPDATE users SET Password = '$newPassword' WHERE Email = '$email'";
        if(mysqli_query($conn, $updateSql)) {
            // Password updated successfully, redirect to login sectionecho "<script>";
            unset($_SESSION['otp_info']);
            session_destroy();
            echo "<script>";
            echo 'swal("password changed", "", "success");';
            echo "  setTimeout(
                        function() { window.location.href = '../account.php'; }, 1000
                    );";
            echo  "</script>";
        } else {
            // Error updating password
            echo "<script>";
            echo 'swal("Failed to update password. Please try again.", "", "error");';
            echo "  setTimeout(
                        function() { window.location.href = '../changePassword.php'; }, 1000
                    );";
            echo  "</script>";
        }
}
?>

</body>
</html>