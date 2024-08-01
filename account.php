<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("links/headLinks.php"); ?>
    <link rel="stylesheet" href="assets/css/account.css">
</head>

<body>
    <?php include("links/nav.php"); ?>

    <section class="container section-t8">
        <nav aria-label="breadcrumb" class="mt-5">
            <ol class="breadcrumb fs-5">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Account</li>
            </ol>
        </nav>
        <div class="accountSection mt-5">
            <div class="sign-in sign-inD">
                <div class="text-center">
                    <p>Not a member? <a href="#" class="signupBtn">Sign up</a></p>
                </div>
                    <form action="backend/signin.php" method="post">
                        <!-- Register buttons -->
                        <div class="row">
                            <div class="col-md-12 p-3">
                                <!-- Email input -->
                                <div class="form-outline mb-4">
                                    <input type="email" id="form2Example1" name="email" placeholder="Email" class="form-control" required />
                                </div>
                                <!-- Password input -->
                                <div class="form-outline mb-4">
                                    <input type="password" id="form2Example2" name="password" placeholder="Password" class="form-control" required />
                                </div>
                                <div class="row mb-4">
                                    <div class="col">
                                        <a href="forgetPassword.php">Forgot password?</a>
                                    </div>
                                </div>
                                <!-- Submit button -->
                                <button type="submit" class="btn btn-outline-success btn-block mb-4">Sign in</button>
                            </div>
                        </div>
                        
                    </form>
            </div>

            <div class="sign-up sign-upD container">
                <div class="text-center mb-3">
                    <p>Already a member? <a href="#!" class="signinBtn">Sign in</a></p>
                </div>
                <form action="backend/signup.php" method="post" id="registrationForm" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6 p-2">
                            <h5 class="mb-3">Registration</h5>
                            <!-- Name -->
                            <div class="mb-3 mt-3">
                                <input type="text" class="form-control" placeholder="Name" aria-label="name" name="name" id="name" required>
                            </div>
                            <!-- NIC, email address, password -->
                            <div class="mb-3 mt-3">
                                <input type="text" class="form-control" id="NIC" placeholder="NIC number" name="nic" required>
                            </div>
                            <div class="mb-3 mt-3">
                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                            </div>
                            <div class="mb-3 mt-3">
                                <input type="password" class="form-control" placeholder="password" name="password" id="password" required>
                            </div>
                            <div class="mb-3 mt-3">
                                <select class="form-select" name="userType">
                                    <option value="1">Bidder</option>
                                    <option value="2">Seller</option>
                                    <option value="3">Both</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 p-2">
                            <h5 class="mb-3">Your details</h5>
                            <!-- Address and city -->
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Address" name="address01" id="inputAddress" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Address 2" name="address02" id="inputAddress2" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="inputCity" placeholder="City" name="city" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="inputZip" placeholder="Zip" name="zip" required>
                            </div>
                            <!-- Profile pic upload -->
                            <div class="mb-3">
                                <input type="file" class="form-control" id="inputGroupFile" aria-label="Upload" name="profilepic" onchange="previewImage(this)" required>
                            </div>
                            <div class="mt-2 text-center">
                                <img id="imagePreview" src="default-profile-image.png" alt="Image Preview" style="max-width: 200px;">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button class="btn btn-outline-success" type="submit">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php include("links/footerLinks.php"); ?>

    <script>
        // img showing 
        function previewImage(input) {
            var preview = document.getElementById('imagePreview');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "default-profile-image.png";
            }
        }

        document.querySelector('.signupBtn').addEventListener('click', function() {
            document.querySelector('.sign-inD').style.display = 'none';
            document.querySelector('.sign-upD').style.display = 'block';
        });

        document.querySelector('.signinBtn').addEventListener('click', function() {
            document.querySelector('.sign-upD').style.display = 'none';
            document.querySelector('.sign-inD').style.display = 'block';
        });
    </script>
</body>
</html>
