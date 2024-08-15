<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <style>
        * {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .custom-container {
            position: relative;
            width: 100%;
        }

        ul {
            all: unset;
            list-style: disc;
            /* padding-left: 20px; */
            margin: 0;
        }

        nav .breadcrumb {
            margin-left: 24px;
        }

        .cardHeader h3 {
            font-weight: 600;
            color: var(--blue);
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        /* ================== Table details ============== */
        .recentOrders {
            position: relative;
            display: grid;
            min-height: 500px;
            background: var(--white);
            padding: 20px;
            box-shadow: 0 7px 25px rgba(0, 0, 0, 0.08);
            border-radius: 20px;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
        }
    </style>

</head>

<body>
    <div class="custom-container">
        <?php
        include 'partials/navigation.php';
        ?>

        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="userName">
                    <div class="user-name">NAMA BINTI PENUH</div>
                    <div class="user">
                        <img src="assets/images/user.png" alt="User Image">
                    </div>
                </div>
            </div>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="staff.php">Staf</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kemaskini Staf</li>
                </ol>
            </nav>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h3>Kemaskini Staf</h3>
                </div>
                <?php
                $id = $_GET['id'];

                // Ensure you escape the ID to prevent SQL injection
                $id = mysqli_real_escape_string($conn, $id);

                $sqlStaff = "SELECT * FROM `pengguna` WHERE id = $id";
                $resultEditStaff = mysqli_query($conn, $sqlStaff);

                // Fetch the staff member's data
                if ($resultEditStaff && mysqli_num_rows($resultEditStaff) > 0) {
                    $staff = mysqli_fetch_assoc($resultEditStaff);
                } else {
                    // Handle the case where no staff member is found
                    echo "No staff member found.";
                    exit;
                }

                ?>

                <form class="updateStaff" method="POST" novalidate>

                    <div class="mb-3">
                        <label for="kumpulan" class="form-label">Kumpulan</label>
                        <select id="kumpulan" class="form-control" name="kumpulan" required>
                            <?php

                            $sqlKumpulan = "SELECT `kump_kod`, `kump_desc` 
                                            FROM `kumpulan` 
                                            WHERE `kump_kod` NOT IN ('X', 'Y', 'Z')";

                            $resultKumpulan = mysqli_query($conn, $sqlKumpulan);
                            // Fetch the current `kump_kod` value from the database
                            $currentKumpKod = $staff['kumpulan']; // Assuming you already have this value from a previous query

                            while ($row = mysqli_fetch_assoc($resultKumpulan)) {
                                // Check if the current `kump_kod` matches the one in the loop
                                $selected = ($row['kump_kod'] == $currentKumpKod) ? 'selected' : '';
                                echo '<option value="' . $row['kump_kod'] . '" ' . $selected . '>' . $row['kump_kod'] . ' - ' . $row['kump_desc'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="nama_staf" class="form-label">Nama Staf:</label>
                        <input type="text" class="form-control" id="nama_staf" name="nama_staf" placeholder="Masukkan Nama Staf" value="<?php echo htmlspecialchars($staff['nama']); ?>" minlength="15" required>
                        <div class="invalid-feedback">
                            Sila masukkan nama staf yang sah.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_kp" class="form-label">Nombor Kad Pengenalan</label>
                        <input type="text" class="form-control" id="no_kp" name="no_kp" placeholder="Masukkan Nombor Kad Pengenalan" value="<?php echo htmlspecialchars($staff['no_kp']); ?>" minlength="12" maxlength="12" required>
                        <div class="invalid-feedback">
                            Sila masukkan nombor kad pengenalan yang sah.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_telefon" class="form-label">Nombor Telefon</label>
                        <input type="tel" class="form-control" id="no_telefon" name="no_telefon" placeholder="Masukkan Nombor Telefon" value="<?php echo htmlspecialchars($staff['contact_no']); ?>" minlength="10" maxlength="11" required>
                        <div class="invalid-feedback">
                            Sila masukkan nombor telefon yang sah.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email_staff" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_staff" name="email_staff" value="<?php echo htmlspecialchars($staff['email']); ?>" placeholder="Masukkan Email">
                        <div class="invalid-feedback">Sila masukkan Email yang betul.</div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($staff['id']); ?>">

                    <div class="modal-footer">

                        <div>
                            <button type="submit" class="btn btn-primary">Kemaskini Staf</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
    <script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.updateStaff')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })

        })()


        $(document).ready(function() {
            $('.updateStaff').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/edit_staff.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Kemaskini Berjaya',
                            }).then(() => {
                                window.location.href = 'staff.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: res.message,
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>