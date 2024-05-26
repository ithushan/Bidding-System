<?php 
session_start();
if(isset($_SESSION['user'])){

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
                <li class="breadcrumb-item active" aria-current="page"> <a href="userPanel.php">Panel</a> </li>
                <li class="breadcrumb-item">Update Details</li>
            </ol>
        </nav>

        <!-- form -->
        <form action="backend/update.php" method="post" id="registrationForm"
            enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4 p-2">
                    <h5 class="mb-3">Registation</h5>
                    <!-- name -->
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" placeholder="Name" aria-label="name" name="name"
                            value="<?php echo $_SESSION['user']['name'] ?>" id="name" required>
                    </div>
                    <!-- NIC, email address password -->
                    <div class="mb-3 mt-3">
                        <input type="text" class="form-control" id="NIC" placeholder="NIC number" name="nic"
                            value="<?php echo $_SESSION['user']['nic'] ?>" required>
                    </div>
                    <div class="mb-3 mt-3">
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email"
                            value="<?php echo $_SESSION['user']['email'] ?>" required>
                    </div>
                    <!-- <div class="mb-3 mt-3">
                        <input type="password" class="form-control" placeholder="password" name="password" id="password" value="<?php echo $_SESSION['user']['nic'] ?>" required>
                    </div> -->
                    <div class="mb-3 mt-3">
                        <select class="form-select" name="userType">
                            <option value="1" <?php echo  $_SESSION['user']['usertype'] == 1 ? 'selected' : ''; ?>>
                                Bidder</option>
                            <option value="2" <?php echo  $_SESSION['user']['usertype'] == 2 ? 'selected' : ''; ?>>
                                Seller</option>
                            <option value="3" <?php echo  $_SESSION['user']['usertype'] == 3 ? 'selected' : ''; ?>>
                                Both</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 p-2">
                    <h5 class="mb-3">Your details</h5>
                    <div class="col-12 mb-3">
                        <textarea class="form-control" placeholder="Address" name="address" id="inputAddress"
                            required><?php echo $_SESSION['user']['address']; ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input type="text" class="form-control" id="inputCity" placeholder="City" name="city"
                            value="<?php echo $_SESSION['user']['city'] ?>" required>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="inputZip" placeholder="Zip" name="zip"
                            value="<?php echo $_SESSION['user']['zip'] ?>" required>
                    </div>
                    <!-- <div class="input-group mt-2">
                        <input type="file" class="form-control" id="inputGroupFile"
                            aria-describedby="inputGroupFileAddon04" aria-label="Upload" placeholder="Your Profile Pic"
                            name="profilepic">
                        <?php if(isset($_SESSION['user']['imgname'])) { ?>
                        <span class="input-group-text"><?php echo $_SESSION['user']['imgname']; ?></span>
                        <?php } ?>
                    </div> -->


                </div>
                <!-- card section -->
                <div class="col-md-4 p-2">
                    <h5 class="mb-3">Add to card</h5>
                    <div class="col-12 mb-3">
                        <input type="text" class="form-control" id="payment_name" placeholder="card holder name"
                            disabled>
                    </div>
                    <div class="col-12 mb-3">
                        <input type="number" class="form-control" id="payment_number" placeholder="xxxx xxxx xxxx xxxx"
                            disabled>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="payment_date" class="form-label">Expiry</label>
                            <input type="date" class="form-control" placeholder="04/2025" aria-label="payment_date"
                                disabled>
                        </div>
                        <div class="col">
                            <label for="payment_cvc" class="form-label">CVV / CVC</label>
                            <input type="number" class="form-control" placeholder="xxx" aria-label="payment_cvc"
                                disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-outline-success" type="submit">Update form</button>
            </div>
        </form>

    </section>
    <?php include("links/footerLinks.php")?>
    <script src="assets/js/account.js"></script>
</body>

</html>

<?php
}
else{
    header('location:account.php');
}
?>