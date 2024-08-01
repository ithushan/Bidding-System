<section class="section-property section-t8">
  <!-- intro section  -->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="title-wrap d-flex justify-content-between">
              <div class="title-box">
                <h2 class="title-a">Recent Auctions</h2>
              </div>
              <div class="title-link">
                <a href="auction.php">All Products
                  <span class="bi bi-chevron-right"></span>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div id="property-carousel" class="swiper">
          <div class="swiper-wrapper">
          <?php 
              include("backend/conn.php");
              // product included in main page && this method get last 4 products .....
              $products = $productObj->getApprovedProductsResent();

              if (!empty($products)) {
                  foreach ($products as $product) {
                      $productObj->renderProductCardResent($product);
                  }
              } else {
                  echo "<div class='col-md-12'><p>No approved products found.</p></div>";
              }

              // Close the database connection
              mysqli_close($conn);
          ?>
          </div>
        </div>
        <div class="propery-carousel-pagination carousel-pagination"></div>
      </div>
    </section>
    <!-- End Latest Properties Section -->



   