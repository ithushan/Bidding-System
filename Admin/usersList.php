<?php 
session_start();
if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        include("components/headlinks.php");
        include('../backend/conn.php');
    ?>
    
</head>
<body>
    <!-- nav bar -->
    <?php include("components/nav.php")?>

    <?php
     include('users.php'); // Fetch user data
     fetchAndStoreUserDetails($conn);
     $userData = [];
     $userData = $_SESSION['userData'];
    
    ?>
    
    <section class="section-t8 container mt-5">
        <h1>Users</h1>
        <div class="row">
            <?php if (!empty($userData)): ?>
                <?php foreach($userData as $user): ?>
                    <div class="col-md-3 mb-4">
                        <div class="card">
                            <a href="userDetail.php?id=<?php echo $user['user_id']; ?>">
                                <!-- <img src="<?php echo "../backend/".$user['ProfilepicName']; ?>" class="card-img-top" alt="User Image" style="object-fit: cover; height: 300px;"> -->
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $user['Name']; ?></h5>
                                    <p class="card-text"><?php echo $user['Email']; ?></p>
                                    <!-- <a  class="btn btn-primary">View Details</a> -->
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        No records found.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php include("components/footerLinks.php")?>
</body>
</html>
<?php
}else{
    header("location:../account.php");
}
?>
