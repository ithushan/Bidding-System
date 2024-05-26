<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="Admin.php">A<span class="color-b">dmin</span></a>

      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link" href="Admin.php">Home</a>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" href="requestProducts.php">Products</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="auction.php">Auctions</a>
          </li> -->

          <!-- <li class="nav-item">
            <a class="nav-link " href="about.php">About</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link " href="contact.php">Contact</a>
          </li> -->
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Products
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class=" dropdown-item" href="requestProducts.php">Pending Requests</a>
                <a class=" dropdown-item" href="approvedProducts.php"> Approved Products</a>
                <a class=" dropdown-item" href="rejectedProducts.php">Rejected Products</a>
            </div>
        </li>
          <li class="nav-item">
            <a class="btn btn-success" href="../logout.php">Log out </a>
          </li>
        </ul>
      </div>
      

    </div>
  </nav>