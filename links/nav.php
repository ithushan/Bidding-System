  <!-- ======= Header/Navbar ======= -->
  <!-- <?php session_start(); ?> -->
  
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="index.php">Bid &<span class="color-b"> Giddy</span></a>

      <div class="navbar-collapse collapse justify-content-end" id="navbarDefault">
        <ul class="navbar-nav">

          <li class="nav-item">
            <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>" href="index.php">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'auction.php') echo 'active'; ?>" href="auction.php">Auctions</a>
          </li>
          <li class="nav-item">
            <?php
              if(isset($_SESSION['user'])){
                echo '<a class="nav-link ' . (basename($_SERVER['PHP_SELF']) == 'userPanel.php' ? 'active' : '') . '" href="userPanel.php">Dashboard</a>';
              }
              else{
                echo '<a class="nav-link ' . (basename($_SERVER['PHP_SELF']) == 'account.php' ? 'active' : '') . '" href="account.php">Start to Sell</a>';
              }
            ?>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'active'; ?>" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'contact.php') echo 'active'; ?>" href="contact.php">Contact</a>
          </li>
          <?php
          if(isset($_SESSION['user'])) {
              // If user is logged in, show Logout button
              echo '<li class="nav-item">
                      <a type="button" class=" btn btn-success"  id="account" href="logout.php"><i class="bi bi-box-arrow-right">  Log out</i></a>
                    </li>';
          } else {
              // If user is not logged in, show Sign In button
              echo '<li class="nav-item">
                      <a type="button" class=" btn btn-outline-success"  id="account" href="account.php"><i class="bi bi-person-plus"> Account</i></a>
                    </li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>


  <!-- user first letter shown -->
  <!-- //     $name = $_SESSION['user']['name'];
              //     $firstLetter = strtoupper(substr($name, 0, 1));
              // echo '<li class="nav-item"><a class=" user-initial rounded-circle mx-auto" href="userPanel.php">' . $firstLetter . '</a></li>'; -->