<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>

<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="homepage.php" class="logo">
                        <img src="../assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
                        <img src="../assets/images/logo.jpeg" alt="" style="width: 120px; height: auto;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li class="scroll-to-section">
                            <a href="homepage.php"
                                class="<?php echo ($current_page == 'homepage.php') ? 'active' : ''; ?>">Laman Utama</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="tempahan.php"
                                class="<?php echo ($current_page == 'tempahan.php') ? 'active' : ''; ?>">Tempah</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="sewaan.php"
                                class="<?php echo ($current_page == 'sewaan.php') ? 'active' : ''; ?>">Sewaan</a>
                        </li>
                        <li class="scroll-to-section">
                            <a href="profil.php"
                                class="<?php echo ($current_page == 'profil.php') ? 'active' : ''; ?>">Profil</a>
                        </li>
                    </ul>

                    <div class="right-nav">
                        <span><?php echo htmlspecialchars($nama); ?></span>
                        <div class="log-out-button">
                            <span id="logoutButton"><ion-icon name="log-out-outline"></ion-icon></span>
                        </div>
                    </div>
                    <!-- ***** Menu End ***** -->
                </nav>

                <nav class="main-nav-min">
                    <!-- ***** Logo Start ***** -->
                    <a href="homepage.php" class="logo">
                        <img src="../assets/images/logo2.png" alt="logoLKTN" style="width: 50px; height: auto;">
                        <img src="../assets/images/logo.jpeg" alt="" style="width: 100px; height: auto;">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">
                            <ion-icon name="ellipsis-vertical"></ion-icon>
                        </button>
                        <div id="myDropdown" class="dropdown-content">
                            <a><span><?php echo htmlspecialchars($nama);?><hr></span></a>
                            <a href="homepage.php">Laman Utama</a>
                            <a href="tempahan.php">Tempah</a>
                            <a href="sewaan.php">Sewaan</a>
                            <a href="profil.php">Profil</a>
                            <a id="logoutButton" href="../login.php">Log Keluar</a>
                        </div>
                    </div>
                    <!-- ***** Menu End ***** -->
                </nav>

            </div>
        </div>
    </div>
</header>