<div class="navigation">
    <ul>
        <li>
            <a href="profile.php">
                <img src="../assets/images/logo2.png" alt="Brand Logo" style="margin-top: 10px; width:60px; height:60px;">
                <span class="title" style="margin-top: 10px; font-size: 18px;">LKTNBooking</span>
            </a>
        </li>

        <li>
            <a href="tempahan.php">
                <span class="icon">
                    <ion-icon name="book-outline"></ion-icon>
                </span>
                <span class="title">Refund</span>
            </a>
        </li>

        
        <li>
            <a href="sejarahTempahan.php">
                <span class="icon">
                    <ion-icon name="time-outline"></ion-icon>
                </span>
                <span class="title">Sejarah</span>
            </a>
        </li>

        <li>
            <a href="profile.php">
                <span class="icon">
                    <ion-icon name="person-circle-outline"></ion-icon>
                </span>
                <span class="title">Profil</span>
            </a>
        </li>

        <li>
            <a href="#" id="logoutButton">
                <span class="icon">
                    <ion-icon name="log-out-outline"></ion-icon>
                </span>
                <span class="title">Sign Out</span>
            </a>
        </li>
    </ul>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                Swal.fire({
                    title: "Logged out!",
                    text: "You have been successfully logged out.",
                    icon: "success"
                }).then(() => {

                    window.location.href = '../controller/auth/logout.php'; // Update with your actual logout URL
                });
            }
        });
    });
</script>