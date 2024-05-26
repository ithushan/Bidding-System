<?php
class Product {
    private $conn;

    public function __construct($dbConnection) {
        echo "<script> console.log('constarcter is worked '); </script>";
        $this->conn = $dbConnection;
    }

    public function solvedPrducts(){
        // Define the current date
        $currentDate = new DateTime();

        // SQL query to select all auction products
        $sql = "SELECT product_id, end_date FROM auctionproducts WHERE status = 'auction time'";
        $result = mysqli_query($this->conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $endDate = new DateTime($row['end_date']);
                
                // Check if the end date has passed
                if ($currentDate > $endDate) {
                    // Update the status to 'solved'
                    $productId = $row['product_id'];
                    $updateSql = "UPDATE auctionproducts SET status = 'solved' WHERE product_id = $productId";
                    mysqli_query($this->conn, $updateSql);
                }
            }
        }
    }

    public function getApprovedProducts() {
        $sql = "SELECT p.*, a.end_date, a.start_date, a.price FROM products p 
                JOIN auctionproducts a ON p.product_id = a.product_id 
                WHERE p.admin_approve_status = 'approved' AND a.status = 'auction time'"; 
        $result = mysqli_query($this->conn, $sql);

        $products = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $products[] = $row;
            }
        }

        return $products;
    }

    public function getApprovedProductsResent() {
        // Modify the SQL to fetch the last 4 approved products
        $sql = "SELECT p.*, a.end_date, a.start_date, a.price 
                FROM products p 
                JOIN auctionproducts a ON p.product_id = a.product_id 
                WHERE p.admin_approve_status = 'approved' AND a.status = 'auction time'
                ORDER BY a.end_date DESC
                LIMIT 4"; 
        $result = mysqli_query($this->conn, $sql);

        $products = [];
        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)){
                $products[] = $row;
            }
        }

        return $products;
    }

    private function getFirstImage($row) {
        $dir = "uploads/sell/" . $row['seller_id'] . "/" . $row['title'] . "/";
        $firstImage = '';
        if (is_dir($dir)){
            $files = scandir($dir);
            foreach($files as $file) {
                if($file != '.' && $file != '..') {
                    $firstImage = $dir . $file;
                    break; // Break the loop after finding the first image
                }
            }
        }
        return $firstImage;
    }

    public function calculateRemainingDays($endDate) {
        $currentDate = new DateTime();
        $end = new DateTime($endDate);
        $diff = $currentDate->diff($end);
    
        // Check if the end date is today
        if ($currentDate->format('Y-m-d') == $end->format('Y-m-d')) {
            return "last day";
        }
    
        // Check if the end date is in the future
        if ($currentDate < $end) {
            $daysRemaining = $diff->format("%a");
            if($daysRemaining == 0){
                return "last day";
            }else if ($daysRemaining == 1) {
                return "1 day more";
            } else {
                return $daysRemaining . " days more...";
            }
        }
        
        if ($currentDate > $end) {
            return "Solved";
        }
    }

    public function renderProductCard($row) {
        $firstImage = $this->getFirstImage($row);
        $remainingDays = $this->calculateRemainingDays($row['end_date']);
        ?>
        <div class="col-md-4">
            <div class="card-box-a card-shadow">
                <div class="img-box-a">
                    <img src="<?php echo htmlspecialchars($firstImage); ?>" alt="" class="img-a img-fluid" style="object-fit: cover;  height: 400px;">
                </div>
                <div class="card-overlay">
                    <div class="card-overlay-a-content">
                        <div class="card-header-a">
                            <p class="card-title-a">
                                <a href="#"><?php echo htmlspecialchars($row['title']); ?></a>
                            </p>
                        </div>
                        <div class="card-body-a">
                            <div class="price-box d-flex">
                                <span class="price-a">LKR <?php echo htmlspecialchars($row['price']); ?></span>
                            </div>
                            <a href="<?php echo 'viewProduct.php?id=' . urlencode($row['product_id']); ?>" class="link-a">Click here to view
                                <span class="bi bi-chevron-right"></span>
                            </a>
                        </div>
                        <div class="card-footer-a">
                            <ul class="card-info d-flex justify-content-around">
                                <li>
                                    <h4 class=''><?php echo $remainingDays; ?></h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function renderProductCardResent($row) {
        $firstImage = $this->getFirstImage($row);
        $remainingDays = $this->calculateRemainingDays($row['end_date']);
        ?>
        <div class="carousel-item-b swiper-slide">
                <div class="card-box-a card-shadow">
                    <div class="img-box-a">
                    <img src="<?php echo htmlspecialchars($firstImage); ?>" alt="" class="img-a img-fluid" style="object-fit: cover;  height: 400px;">
                    </div>
                    <div class="card-overlay">
                    <div class="card-overlay-a-content">
                        <div class="card-header-a">
                        <p class="card-title-a">
                            <a href="#"><?php echo htmlspecialchars($row['title']); ?></a>
                        </p>
                        </div>
                        <div class="card-body-a">
                        <div class="price-box d-flex">
                            <span class="price-a">LKR <?php echo htmlspecialchars($row['price']); ?></span>
                        </div>
                        <a href="<?php echo 'viewProduct.php?id=' . urlencode($row['product_id']); ?>" class="link-a">Click here to view
                            <span class="bi bi-chevron-right"></span>
                        </a>
                        </div>
                        <div class="card-footer-a">
                            <ul class="card-info d-flex justify-content-around">
                                <li>
                                    <h4 class=''><?php echo $remainingDays; ?></h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <?php
    }
}
?>
