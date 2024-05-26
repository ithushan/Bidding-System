<!DOCTYPE html>
<html lang="en">

<head>
  <?php 
  include("links/headLinks.php");
  include("product.php");
  include("backend/conn.php");
  $productObj = new Product($conn); 
  $productObj->solvedPrducts();
  ?>
</head>

<body>

<!-- nav bar -->
<?php include("links/nav.php") ?>


<!-- intro section carousel -->
<?php include("indexComponents/introSection.php") ?>

<!-- wellcome -->
<?php include("indexComponents/wellcome.php")?>

<!--  latest section  -->
<?php include("indexComponents/resentAuctions.php")?> 

<!-- servisec section -->
<?php include("indexComponents/services.php") ?>

<!-- how it works  -->
<?php include("indexComponents/working.php")?>

<!-- customer Reviews -->
<?php include("indexComponents/cusReview.php")?>


<!-- footer section -->
<?php include("links/footerSection.php")?>


<!-- js links  -->
<?php include("links/footerLinks.php")?>

<script src="assets/js/account.js"></script>
</body>

</html>

 <!--  latest section  -->
<!-- <?php include("resentAuctions.php")?>  -->