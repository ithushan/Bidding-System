<?php

// session_start();
// include('../backend/conn.php');


function fetchAndStoreUserDetails($conn) {

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $userData = [];
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['Name'];
            $userData[] = $row;
        }

        $_SESSION['userData'] = $userData;

        echo "User details stored in session successfully.";
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }
}

// fetchAndStoreUserDetails($conn);

// mysqli_close($conn);
?>
