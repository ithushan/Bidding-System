<!DOCTYPE html>
<html lang="en">
<head>
   
</head>
<body>
    


      <?php
      include("backend/conn.php");
        $currentDate = new DateTime();
        echo $currentDate->format('Y-m-d');
        echo "<br>";

      $sql = "SELECT product_id, end_date FROM auctionproducts WHERE status = 'auction time'";
      $result = mysqli_query($conn, $sql);
      if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $endDate = new DateTime($row['end_date']);
            $diff = $endDate->diff($endDate);
            echo $currentDate->format('Y-m-d');
            echo "<br>";
            echo $diff->format("%a");
            echo "<br>";
            echo "loop worked";
            echo "<br>";
            if ($currentDate < $endDate) {
                // Update the status to 'solved'
                // $productId = $row['product_id'];
                echo $row['product_id'];
                echo "<br>";
                // $updateSql = "UPDATE auctionproducts SET status = 'solved' WHERE product_id = $productId";
                // mysqli_query($this->conn, $updateSql);
            }
        }
    }
        // $currentDate = new DateTime();
        // echo $currentDate->format('Y-m-d H:i:s');
      ?>
      
</body>
</html>