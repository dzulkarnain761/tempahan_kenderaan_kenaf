<?php
// Get the current page name
$current_page = basename($_SERVER['PHP_SELF']);
?>
<style>
.profile-link {
    text-decoration: none; /* Hilangkan garis bawah */
    color: inherit; /* Kekalkan warna teks asal */
}

.profile-link:hover {
    color: #4da6e7; /* Tukar warna kepada biru apabila di-hover */
}

#logoutButton {
    color: inherit; /* Kekalkan warna asal */
    text-decoration: none; /* Hilangkan garis bawah */
}

#logoutButton:hover {
    color: red; /* Tukar warna kepada merah apabila di-hover */
}

</style>

<header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="homepage.php" class="logo">
                        <img src="../assets/images/logo_tempahan_kenderaan.png" alt="" style="width: auto; height: 40px;">
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
                            <a href="sejarahTempahan.php"
                                class="<?php echo ($current_page == 'sejarahTempahan.php') ? 'active' : ''; ?>">Sejarah</a>
                        </li>
                    </ul>

                    <div class="right-nav">
						<a href="profil.php" class="profile-link">
							<span><?php echo htmlspecialchars($nama); ?></span>
						</a>
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
                            <a id="logoutButton" href="#">Log Keluar</a>
                        </div>
                    </div>
                    <!-- ***** Menu End ***** -->
                </nav>

            </div>
        </div>
    </div>
</header>

<script>
    const logoutButton = document.getElementById('logoutButton');

// Add a click event listener to the logout button
logoutButton.addEventListener('click', function() {
    // Show the confirmation dialog
    Swal.fire({
        title: "Log Keluar",
        // text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Batal",
        confirmButtonText: "Log Keluar"
    }).then((result) => {
        if (result.isConfirmed) {
            // Handle the logout logic here (e.g., redirecting to a logout route)
            // Example: window.location.href = '/logout';

            // Show the success dialog
            Swal.fire({
                title: "Log Keluar!",
                text: "Anda telah berjaya log keluar.",
                icon: "success"
            }).then(() => {
                // Optionally, redirect the user after the success dialog
                window.location.href = '../controller/auth/logout.php'; // Update with your actual logout URL
            });
        }
    });
});
</script>