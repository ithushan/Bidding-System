<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection
    include("conn.php");

    // Get updated values from the form
    $name = $_POST["name"];
    $nic = $_POST["nic"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zip = $_POST["zip"];
    $userType = $_POST["userType"];

    // Update the user's details in the database
    $sql = "UPDATE users SET Name = '$name', NICnumber = '$nic', Email = '$email', AddressL = '$address', City = '$city', Zipcode = '$zip', UserType = '$userType' WHERE Email = '{$_SESSION['user']['email']}'";

    if (mysqli_query($conn, $sql)) {
        // Update session variables as well
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['nic'] = $nic;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['city'] = $city;
        $_SESSION['user']['zip'] = $zip;
        $_SESSION['user']['usertype'] = $userType;

        // Redirect back to the profile page with a success message
        echo "<script>";
        echo 'swal("Done", "", "success");';
        echo "  setTimeout(
                    function() { window.location.href = '../userPanel.php'; }, 2200
                );";
        echo  "</script>";
        exit();
    } else {
        // If update fails, redirect back to the profile page with an error message
        echo "<script>";
        echo 'swal("Failed", "", "error");';
        echo "  setTimeout(
                    function() { window.location.href = '../updateUserDetails.php'; }, 2200
                );";
        echo  "</script>";
        exit();
    }
}
?>

</body>
</html>