<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("components/headlinks.php")?>
</head>
<body>
    <!-- nav bar -->
    <?php include("components/nav.php")?>

    <!-- main -->
    <?php 
    include('../backend/readProducts.php');
    if(isset($_SESSION['productData'])){
    ?>
    <section class="section-t8 container mt-5"  >
            <?php
                $currentPage = basename($_SERVER['PHP_SELF']);
                if ($currentPage === 'requestProducts.php'){
                    echo "<h1>Request products</h1>";
                    $src = "request";
                }else if($currentPage === 'approvedProducts.php'){
                    echo "<h1>Approved products</h1>";
                    $src = "approved";
                }else if($currentPage === 'rejectedProducts.php'){
                    echo "<h1>Rejected products</h1>";
                    $src = "rejected";
                }
            ?>
        
        <div class="list-group m-3">
            <?php if (!empty($productData)): ?>
                <?php foreach($productData as $product): ?>
                    <a href="productDetail.php?id=<?php echo $product['product_id']; ?>&source=<?php echo $src?>" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><?php echo $product['title']; ?></h5>
                            <small><?php echo $product['created_at']?></small>
                        </div>
                        <p class="mb-1"><?php echo $product['description']?> . </p>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="list-group-item">
                    <p class="mb-1">No records found.</p>
                </div>
            <?php endif; ?>
        </div>

    </section>
    <?php
    }
    ?>
    
    
    <?php include("components/footerLinks.php")?>
</body>
</html>
