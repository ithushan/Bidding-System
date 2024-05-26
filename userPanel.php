<?php 
session_start();
if(isset($_SESSION['user'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("links/headLinks.php"); ?>
</head>
<body>
<!-- nav bar -->
<?php include("links/nav.php")?>

<!-- ======= Intro Single ======= -->

<section class="intro-single mt-1">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="title-single-box">
                    <h1 class="title-single"><?php echo $_SESSION['user']['name'] ?></h1>
                    <p><?php 
                        echo $_SESSION['user']['email'] ;
                        echo '<br>';
                        echo $_SESSION['user']['nic'] ;
                        echo '<br>';
                        echo $_SESSION['user']['address'] ;
                        echo '<br>';
                        echo $_SESSION['user']['city'] ;
                        echo '<br>';
                        echo $_SESSION['user']['zip'] ;
                        ?>
                    </p>
                    <a href="updateUserDetails.php">Edit Your Profile</a>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center">
                <img src="backend/<?php echo $_SESSION['user']['imgname'] ;  ?>" alt="img" class="rounded mx-auto d-block">
            </div>
            <div class="col-md-4">
                <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.php">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Panel
                        </li>
                    </ol>
                </nav>

            </div>
        </div>
    </div>
</section>
<!-- End Intro Single-->

<div class="container">
    <div class="panel">
            <div class="row">
                <div class="col-md-4 panel-cards panel-bid p-4">
                    <h4> <i class="bi bi-search mr-2"></i> bid events</h4>
                    <p>Details about the bidding events .</p>
                </div>
                <div class="col-md-4 panel-cards panel-pay  p-4">
                   <h4>  <i class="bi bi-cart mr-2"></i> Pay</h4>
                   <p>Review won lots pay invoices Contact with sellers .</p>
                </div>
                <div class="col-md-4 panel-cards panel-sell p-4">
                    <h4> <i class="bi bi-bag mr-2"></i>Sell</h4>
                    <p>Upgrade to a vendor account to start selling your own lots .</p>
                </div>
            </div>
    </div>
</div>




    <?php include("links/footerLinks.php")?>
    <script src="assets/js/userPanel.js"></script>
</body>
</html>

<?php
}
else{
    header('location:account.php');
}
?>