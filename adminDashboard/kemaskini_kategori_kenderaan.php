<?php
include 'controller/connection.php';

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
            min-height: 300px;
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
                    <li class="breadcrumb-item"><a href="tetapan.php">Tetapan</a></li>
                    <li class="breadcrumb-item"><a href="crud_kategori_kenderaan.php">Kategori Kenderaan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kemaskini Kategori Kenderaan</li>
                </ol>
            </nav>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h3>Kemaskini Kategori Kenderaan</h3>
                </div>

                <?php
                $id = $_GET['id'];

                // Ensure you escape the ID to prevent SQL injection
                $id = mysqli_real_escape_string($conn, $id);

                $sqlKategoriKenderaan = "SELECT * FROM `kategori_kenderaan` WHERE id = $id";
                $resultKategoriKenderaan = mysqli_query($conn, $sqlKategoriKenderaan);

                // Fetch the Pemandu member's data
                if ($resultKategoriKenderaan && mysqli_num_rows($resultKategoriKenderaan) > 0) {
                    $kategori_kenderaan = mysqli_fetch_assoc($resultKategoriKenderaan);
                } else {
                    // Handle the case where no Pemandu member is found
                    echo "Tiada Kenderaan Dijumpai";
                    exit;
                }

                ?>

                <form class="editKategoriKenderaan">

                    <div class="mb-3">
                        <label for="kategori_input" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" id="kategori_input" name="kategori_kenderaan" value="<?php echo htmlspecialchars($kategori_kenderaan['kategori']) ?>" placeholder="Masukkan Nama Kategori Baharu" required>
                        <div class="invalid-feedback">
                            Sila masukkan kategori.
                        </div>
                    </div>
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($kategori_kenderaan['id']) ?>">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Kemaskini Kategori Kenderaan</button>
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
            const forms = document.querySelectorAll('.editKategoriKenderaan')

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
            $('.editKategoriKenderaan').on('submit', function(e) {
                e.preventDefault();

                // Check if form is valid before making AJAX request
                if (!this.checkValidity()) {
                    e.stopPropagation();
                    return;
                }

                // Serialize form data and make AJAX request
                $.ajax({
                    url: 'controller/edit/edit_kategori_kenderaan.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Penambahan Berjaya',
                            }).then(() => {
                                window.location.href = 'crud_kategori_kenderaan.php';
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