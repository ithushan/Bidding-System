<!-- ======= Services Section ======= -->
<section class="section-services section-t8">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
            <h2 class="title-a">Our Services</h2>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
        <div class="card-box-c foo">
            <div class="card-header-c d-flex">
            <div class="card-box-ico">
            <span class="bi bi-arrow-up-circle"></span>
            </div>
            <div class="card-title-c align-self-center">
                <h2 class="title-c">Biding</h2>
            </div>
            </div>
            <div class="card-body-c">
            <p class="content-c lh-base">
            Experience the thrill of bidding on our online auction platform. Place competitive offers and outbid your rivals to secure coveted items. From rare collectibles to everyday essentials, discover a diverse selection of treasures. Join the excitement and win incredible deals today!
            </p>
            </div>
            <div class="card-footer-c">
            <a href="auction.php" class="link-c link-icon">Start biding
            </a>
            </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="card-box-c foo">
            <div class="card-header-c d-flex">
            <div class="card-box-ico">
            <span class="bi bi-cash"></span>
            </div>
            <div class="card-title-c align-self-center">
                <h2 class="title-c">Sell</h2>
            </div>
            </div>
            <div class="card-body-c">
            <p class="content-c lh-base">
            Effortlessly list your items on our online auction platform. Reach a global audience and set your starting price. Watch bids roll in and maximize your profits. Sell confidently with our secure payment system and unlock new opportunities.
            </p>
            </div>
            <div class="card-footer-c">
            <a href="<?php echo isset($_SESSION['user']) ? 'userPanel.php' : 'account.php'; ?>" class="link-c link-icon">sell product</a>

            </div>
        </div>
        </div>
    </div>
    </div>
</section>
<!-- End Services Section -->