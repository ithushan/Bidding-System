<?php 
session_start();
if(isset($_SESSION)){
?>
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
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $email = isset($_POST["email"]) ? htmlspecialchars($_POST["email"]) : "";
        $password = isset($_POST["password"]) ? htmlspecialchars($_POST["password"]) : "";

        // Check in the database
        $sql = "SELECT * FROM users WHERE Email = '$email' AND Password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            // If a matching user is found
            $row = mysqli_fetch_assoc($result);

            // Check if the user is an admin
            if ($row['Usertype'] == 4) {
                // If the user is an admin, store admin details in session variables
                $_SESSION['admin'] = array(
                    'name' => $row['Name'],
                    'nic' => $row['NICnumber'],
                    'email' => $row['Email'],
                    'address' => $row['AddressL'],
                    'city' => $row['City'],
                    'zip' => $row['Zipcode'],
                    'imgname' => $row['ProfilepicName']
                    // Add any other admin-specific details you need
                );

                // Redirect to admin panel page
                header('Location: ../Admin/Admin.php');
                exit(); // Ensure script stops execution after redirect
            } else {
                // If the user is not an admin, store regular user details in session variables
                $_SESSION['user'] = array(
                    'id' => $row['user_id'],
                    'name' => $row['Name'],
                    'email' => $row['Email'],
                    'address' => $row['AddressL'],
                    'nic' => $row['NICnumber'], 
                    'city' => $row['City'], 
                    'zip' => $row['Zipcode'], 
                    'imgname' => $row['ProfilepicName'],
                    'usertype' => $row['Usertype']
                );

                // Redirect to user panel page
                echo "<script>";
                echo 'swal("Login success", "", "success");';
                echo "  setTimeout(
                            function() { window.location.href = '../userPanel.php'; }, 2200
                        );";
                echo  "</script>";
                exit(); // Ensure script stops execution after redirect
            }
        } else {
            // If no match found
            echo "<script>";
            echo 'swal("Login failed !", "", "error");';
            echo "  setTimeout(
                            function() { window.location.href = '../account.php'; }, 2200
                        );";
            echo  "</script>";
        }
    }
?>

</body>
</html>

<?php 
}else{
    header("location:../account.php");
}
?>