<div class="leftside-menu">

    <!-- LOGO -->
    <a href="homepage.php" class="logo text-center logo-light">
        <span class="logo-lg">
            <img src="../../assets/images/logo/logo_tempahan_kenderaan_white.png" alt="" height="45">
        </span>
        <span class="logo-sm">
            <img src="../../assets/images/logo/logo_lktn.png" alt="" height="45">
        </span>
    </a>



    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav"><br>


            <li class="side-nav-item">
                <a href="homepage.php" class="side-nav-link">
                    <i class="uil-home"></i>
                    <span>LAMAN UTAMA</span>
                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSejarah" aria-expanded="false" aria-controls="sidebarSejarah" class="side-nav-link">
                    <i class="uil-history"></i>
                    <span>KHIDMAT JENTERA</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSejarah">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="tempah_khidmat_jentera.php">TEMPAHAN</a>
                        </li>
                        <li>
                            <a href="tempahan_khidmat_jentera_terkini.php">TEMPAHAN TERKINI</a>
                        </li>
                        <li>
                            <a href="sejarah_tempahan_khidmat_jentera.php">TEMPAHAN TERDAHULU</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="side-nav-item">
                <a href="profil.php" class="side-nav-link">
                    <i class="uil-user"></i>
                    <?php  
                    
                    require_once '../../Models/Penyewa.php';
                    $penyewa = new Penyewa();

                    $checkBankInfo = $penyewa->isBankInfoExist($_SESSION['id']);
                    if($checkBankInfo == false){
                        echo '<span class="badge bg-danger float-end">!</span>';
                    }
                    
                    ?>
                    
                    <span> PROFIL </span>
                </a>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->