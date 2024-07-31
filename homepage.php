<?php
session_start();

if (!isset($_SESSION["pengguna_id"])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Boost your website traffic with our digital media agency. Explore our services to enhance your online presence.">
    <meta name="author" content="Your Name">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Booking</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/homepage.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="homepage.php" class="logo">
                            <img src="assets/images/logo.jpeg" alt="" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php" class="active">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="bayaran.php">Bayaran</a></li>
                            <li class="scroll-to-section">
                                <div class="border-first-button"><a href="controller/logout.php">Logout</a></div>
                            </li>
                        </ul>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Start ***** -->
    <div class="main-banner wow fadeIn" id="top" data-wow-duration="1s" data-wow-delay="0.5s">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6 align-self-center">
                <div class="left-content show-up header-text wow fadeInLeft" data-wow-duration="1s" data-wow-delay="1s">
                  <div class="row">
                    <div class="col-lg-12">
						<h6>Selamat Datang!</h6>
						<h2>TEMPAHAN KENDERAAN LEMBAGA KENAF DAN TEMBAKAU</h2>
						<p>Selamat datang ke laman tempahan kenderaan kami! Kami menawarkan pelbagai pilihan kenderaan untuk memenuhi keperluan anda. Terima kasih.</p>
					</div>
                    <div class="col-lg-12">
                      <div class="border-first-button scroll-to-section">
                        <a href="tempahan.php">Tempah</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="right-image wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                  <img src="assets/images/farm-tractor-concept-illustration.png" alt="Farm Tractor">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <!-- ***** Main Banner End ***** -->

  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js" defer></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js" defer></script>
  <script src="assets/js/owl-carousel.js" defer></script>
  <script src="assets/js/animation.js" defer></script>
  <script src="assets/js/imagesloaded.js" defer></script>
  <script src="assets/js/custom.js" defer></script>

</body>
</html>
