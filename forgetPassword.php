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
                <form action="backend/forgetP.php" method="post">
                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form2Example1">Email address</label>
                        <input type="email" id="form2Example1" name="email" class="form-control" required />
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-outline-success btn-block mb-4">OTP send email</button>
                </form>
            </div>
        </div>

    </section>


    <?php include("links/footerLinks.php")?>
    <script src="assets/js/account.js"></script>
</body>

</html>