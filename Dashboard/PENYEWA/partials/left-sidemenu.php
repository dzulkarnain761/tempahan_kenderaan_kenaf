<style>

.leftside-menu {
   background-image: linear-gradient(to bottom right, #98FB91 ,  #08B118);
    color: white; /* Untuk warna teks */
    height: 100vh; /* Pastikan sidebar penuh ikut ketinggian viewport */
}




</style>



<div class="leftside-menu" style="background-image: linear-gradient(to bottom right,  #98FB91 ,  #08B118); color: white; height: 100vh;">

    <!-- LOGO -->
    <a href="homepage.php" class="logo text-center" style="color: blue;">
        <span class="logo-lg">
            <img src="../../assets/images/logo/logo baru.png" alt="" height="70">
        </span>
        <span class="logo-sm">
            <img src="../../assets/images/logo/logo baru.png" alt="" height="45">
        </span>
    </a>



    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav"><br>


            <li class="side-nav-item">
                <a href="homepage.php" class="side-nav-link">
                   <i class="uil-home" style="color: #162a65;"></i>
                    <span style="color: #162a65;">LAMAN UTAMA</span>

                </a>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarSejarah" aria-expanded="false" aria-controls="sidebarSejarah" class="side-nav-link">
                    <i class="uil-history"  style="color: #162a65;" ></i>
                    <span style="color: #162a65;">KHIDMAT JENTERA</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSejarah">
                    <ul class="side-nav-second-level">
                        <li style="color: #162a65;">
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
                    <i class="uil-user"  style="color: #162a65;"></i>
                    <?php  
                    
                    require_once '../../Models/Penyewa.php';
                    $penyewa = new Penyewa();

                    $checkBankInfo = $penyewa->isBankInfoExist($_SESSION['id']);
                    if($checkBankInfo == false){
                        echo '<span class="badge bg-danger float-end">!</span>';
                    }
                    
                    ?>
                    
                    <span style="color: #162a65;"> PROFIL </span>
                </a>
            </li>

        </ul>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->