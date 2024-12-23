 <style>

img.responsive {
  max-width: 100%;
  height: auto;
}

@media only screen and (min-width: 992px) { /* ukuran layar desktop biasanya dimulai pada 992px */
  .header-item, .dropdown-menu {
    font-size: 16px; /* Atau ukuran yang sesuai */
  }

  img.responsive {
    max-height: 25px; /* Tinggi maksimum untuk logo */
    width: auto; /* Lebar akan menyesuaikan secara otomatis */
  }
  
  /* Sesuaikan elemen lain yang mungkin terlalu besar */
  .some-other-class {
    padding: 10px; /* Contoh, mengurangi padding */
  }
}


</style>


<div class="navbar-custom">
	
	
    <ul class="list-unstyled topbar-menu float-end mb-0">
        

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0 d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="../../assets/images/logo/profil_dark.png" alt="user-image" class="rounded-circle" height="12">
                </span>
                <span class="account-user-name ms-2"><?php echo $first_name ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selamat Datang !</h6>
                </div>

                <!-- item-->
                <a href="profil.php?id=" class="dropdown-item notify-item">
                    <i class="mdi mdi-account-circle me-1"></i>
                    <span>Akaun saya</span>
                </a>

                <!-- item-->
                <a href="../../Controller/auth/logout.php" class="dropdown-item notify-item">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Log Keluar</span>
                </a>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button> 
	<!--<li class="list-inline-item">
    <a href="" data-bs-toggle="tooltip" data-placement="top" >
        <span class="d-block" style="color: white;">
            <!-- Your text goes here 
            -
        </span>
        <img src="../../assets/images/logo/headlktnhijau.png" alt="" height="25" class="responsive">

    </a>
</li>-->


</div>
<!-- end Topbar -->