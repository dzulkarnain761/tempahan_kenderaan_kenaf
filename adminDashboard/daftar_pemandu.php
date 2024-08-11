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

    <style>
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
                    <li class="breadcrumb-item"><a href="staff.php">PEMANDU</a></li>
                    <li class="breadcrumb-item active" aria-current="page">DAFTAR</li>
                </ol>
            </nav>

            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>DAFTAR PEMANDU</h2>
                    </div>

                    <form>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NAMA PEMANDU</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Nama Pemandu">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NO KAD PENGENALAN</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan No Kad Pengenalan">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NO TELEFON</label>
                            <input type="tel" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan No Telefon">
                        </div>
                        <div class="mb-3">
                            <label for="sewa" class="form-label">KATEGORI LESEN :</label>
                            <select id="sewa" class="form-control" name="sewa">
                                <option disabled selected>Sila Pilih Kategori Lesen</option>
                                <option value="jam/harian">Per Jam atau Harian</option>
                                <option value="bulanan">Bulanan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">TARIKH TAMAT LESEN</label>
                            <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="Pilih Tarikh Tamat Lesen">
                        </div>
                        <div class="mb-3">
                            <label for="sewa" class="form-label">STATUS :</label>
                            <select id="sewa" class="form-control" name="sewa">
                                <option disabled selected>Sila Pilih Status</option>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">KATA LALUAN</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Masukkan Kata Laluan">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">SAHKAN KATA LALUAN</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Sahkan Kata Laluan">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">DAFTAR STAFF</button>
                        </div>
                    </form>



                </div>
            </div>
        </div>




    </div>

    <script src="assets/js/main.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


</body>

</html>