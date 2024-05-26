<?php
session_start();
if(isset($_SESSION['otp_info'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("links/headLinks.php")?>
    <link rel="stylesheet" href="assets/css/account.css">
</head>

<body>
    <section class="container section-t8">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="account.php">Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Forget password</li>
            </ol>
        </nav>
        <div class="accountSection mt-5">
            <div class="sign-in sign-inD">
                <form action="backend/changePass.php" method="post" id="changePassword" >
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Enter your new password</label>
                        <input type="password" class="form-control" id="password" placeholder="password" name="password"
                             required>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-outline-success btn-block mb-4" >Change password</button>
                </form>
            </div>
        </div>

    </section>

    <script src="assets/js/forgetPassword.js"></script>
    <?php include("links/footerLinks.php")?>
</body>

</html>

<?php
}
else{
    header('location:account.php');
}
?>
