<section class="section-property section-t8">
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
              // include("Product.php"); 

              // $productObj = new Product($conn); // Create an instance of the Product class
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



    <!-- old code <div class="carousel-item-b swiper-slide">
              <div class="card-box-a card-shadow">
                <div class="img-box-a">
                  <img src="assets/img/auctions-products/t.jpg" alt="" class="img-a img-fluid">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <p class="card-title-a">
                        <a href="#">Gallery Clearance of Rare, Limited Edition Art by Picasso, Monet, Kandinsky, Lowry, Dali, Klimt & Warhol</a>
                      </p>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">LKR 120.00</span>
                      </div>
                      <a href="#" class="link-a">Click here to view
                        <span class="bi bi-chevron-right"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Starts</h4>
                          <span>Mar 11, 2024 12:00 PM
                          </span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Ends from</h4>
                          <span> Mar 25, 2024 07:30 PM</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="carousel-item-b swiper-slide">
              <div class="card-box-a card-shadow">
                <div class="img-box-a">
                  <img src="assets/img/auctions-products/computer.jpg" alt="" class="img-a img-fluid">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <p class="card-title-a">
                        <a href="#">Gallery Clearance of Rare, Limited Edition Art by Picasso, Monet, Kandinsky, Lowry, Dali, Klimt & Warhol</a>
                      </p>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">LKR 120.00</span>
                      </div>
                      <a href="#" class="link-a">Click here to view
                        <span class="bi bi-chevron-right"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Starts</h4>
                          <span>Mar 11, 2024 12:00 PM
                          </span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Ends from</h4>
                          <span> Mar 25, 2024 07:30 PM</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="carousel-item-b swiper-slide">
              <div class="card-box-a card-shadow">
                <div class="img-box-a">
                  <img src="assets/img/auctions-products/paint.jpg" alt="" class="img-a img-fluid">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <p class="card-title-a">
                        <a href="#">Gallery Clearance of Rare, Limited Edition Art by Picasso, Monet, Kandinsky, Lowry, Dali, Klimt & Warhol</a>
                      </p>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">LKR 120.00</span>
                      </div>
                      <a href="#" class="link-a">Click here to view
                        <span class="bi bi-chevron-right"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Starts</h4>
                          <span>Mar 11, 2024 12:00 PM
                          </span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Ends from</h4>
                          <span> Mar 25, 2024 07:30 PM</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="carousel-item-b swiper-slide">
              <div class="card-box-a card-shadow">
                <div class="img-box-a">
                  <img src="assets/img/auctions-products/paint.jpg" alt="" class="img-a img-fluid">
                </div>
                <div class="card-overlay">
                  <div class="card-overlay-a-content">
                    <div class="card-header-a">
                      <p class="card-title-a">
                        <a href="#">Gallery Clearance of Rare, Limited Edition Art by Picasso, Monet, Kandinsky, Lowry, Dali, Klimt & Warhol</a>
                      </p>
                    </div>
                    <div class="card-body-a">
                      <div class="price-box d-flex">
                        <span class="price-a">LKR 120.00</span>
                      </div>
                      <a href="#" class="link-a">Click here to view
                        <span class="bi bi-chevron-right"></span>
                      </a>
                    </div>
                    <div class="card-footer-a">
                      <ul class="card-info d-flex justify-content-around">
                        <li>
                          <h4 class="card-info-title">Starts</h4>
                          <span>Mar 11, 2024 12:00 PM
                          </span>
                        </li>
                        <li>
                          <h4 class="card-info-title">Ends from</h4>
                          <span> Mar 25, 2024 07:30 PM</span>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->