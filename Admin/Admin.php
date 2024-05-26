<?php
session_start();
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("components/headlinks.php")?>
</head>
<body>
    <!-- nav bar -->
    <?php include("components/nav.php")?>

    <div class="container mt-5">
        <h1>Wellcome to <?php echo $_SESSION['admin']['name']?></h1>
        <br>
        <h2>Admin email address: <?php echo $_SESSION['admin']['email']?></h2>
    </div>
    
    <?php include("components/footerLinks.php")?>
</body>
</html>
<?php
}
else{
    
    header("location:../account.php");
}
?>