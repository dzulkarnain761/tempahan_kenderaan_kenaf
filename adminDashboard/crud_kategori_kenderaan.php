<?php

include 'controller/connection.php';
include 'controller/session.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>eBooking</title>
	<link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">


    <style>
        
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

                <?php include 'partials/name_display.php' ?>
            </div>

            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="tetapan.php">Tetapan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kategori Kenderaan</li>
                </ol>
            </nav>

            <div class="recentOrders">
                <div class="cardHeader">
                    <h3>Kategori Kenderaan</h3>
                    <a class="btn" onclick="window.location.href = 'tambah_kategori_kenderaan.php'">TAMBAH KATEGORI</a>
                </div>


                <table>
                    <thead>
                        <tr>
                            <td>Bil</td>
                            <td>Kategori</td>
                            <td>Tindakan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // SQL query to select all staff excluding specific groups
                        $sqlLesen = "SELECT * FROM `kategori_kenderaan`";

                        $resultLesen = mysqli_query($conn, $sqlLesen);
                        $count = 1;

                        // Loop through the result set
                        while ($row = mysqli_fetch_assoc($resultLesen)) {
                        ?>
                            <tr data-id="<?php echo $row['id']; ?>">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['kategori']; ?></td>
                                <td>
                                    <button onclick="window.location.href = 'kemaskini_kategori_kenderaan.php?id=<?php echo $row['id']; ?>'" class="btn btn-outline-edit">
                                        <i class="fas fa-edit" style="font-size: 1.5em;"></i>
                                    </button>
                                    <button onclick="deleteItem(this)" class="btn btn-outline-delete"> <!-- Pass this to the function -->
                                        <i class="fas fa-trash-alt" style="font-size: 1.5em;"></i>
                                    </button>

                                </td>
                            </tr>
                        <?php
                            $count++;
                        }
                        ?>
                    </tbody>
                </table>

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

        function deleteItem(button) {
            var row = button.closest('tr'); // Find the closest <tr> element
            var kategoriId = row.getAttribute('data-id'); // Get the data-id from <tr>

            Swal.fire({
                title: "Adakah anda pasti?",
                text: "Anda tidak akan dapat membatalkan ini!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, padamkannya!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'controller/delete/delete_kategori_kenderaan.php',
                        type: 'POST',
                        data: {
                            id: kategoriId
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Berjaya dipadam!",
                                text: "Kenderaan telah dipadam.",
                                icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Ralat!",
                                text: "Ralat berlaku semasa memadam kenderaan.",
                                icon: "error"
                            });
                        }
                    });
                }
            });

        }
    </script>


</body>

</html>