<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">
        
        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0 d-flex align-items-center" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="../../assets/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle" height="35">
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


</div>
<!-- end Topbar -->