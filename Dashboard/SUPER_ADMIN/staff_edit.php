<?php include 'controller/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'partials/head.php'; ?>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'partials/left-sidemenu.php'; ?>

        <div class="content-page">
            <div class="content">

                <?php include 'partials/topbar.php'; ?>

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="staff.php">Staff</a></li>
                                        <li class="breadcrumb-item active">Kemaskini Staff</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Kemaskini Staff</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    require_once '../../Models/Admin.php';
                                    $admin = new Admin();
                                    $staff = $admin->findById($_GET['staff_id']);
                                    ?>
                                    <form id="updateProfil">
                                        <div class="row mb-3">
                                            <label for="staff_id" class="col-3 col-form-label">Staff ID</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo $staff['id']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_kp" class="col-3 col-form-label">No Kad Pengenalan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="no_kp" name="no_kp" value="<?php echo $staff['no_kp']; ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama_staff" class="col-3 col-form-label">Nama</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="nama_staff" name="nama_staff" value="<?php echo $staff['nama']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-3 col-form-label">Email</label>
                                            <div class="col-9">
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $staff['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="contact_no" class="col-3 col-form-label">No Panggilan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo $staff['contact_no']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="kumpulan_kod" class="col-3 col-form-label">Kumpulan</label>
                                            <div class="col-9">
                                                <select class="form-select" name="kumpulan_kod" id="kumpulan_kod" required>
                                                    <option value="">Pilih Kumpulan</option>
                                                    <?php
                                                    require_once '../../Models/Kumpulan.php';
                                                    $kumpulan = new Kumpulan();
                                                    $groups = $kumpulan->getKumpulanStaff();

                                                    foreach ($groups as $group) {
                                                        echo '<option value="' . $group['kump_kod'] . '"';
                                                        if ($group['kump_kod'] == $staff['kumpulan']) {
                                                            echo ' selected';
                                                        }
                                                        echo '>' . $group['kump_desc'] . '</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="justify-content-end row">
                                            <div class="col-9">
                                                <button type="submit" onclick="updateProfil()" class="btn btn-info">Kemaskini</button>
                                            </div>
                                        </div>
                                    </form>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                </div> <!-- container -->

            </div> <!-- content -->


            <?php include 'partials/footer.php'; ?>

        </div>


    </div>
    <!-- END wrapper -->


    <?php include 'partials/script.php'; ?>

    <script>
        function updateProfil() {
            const form = document.getElementById('updateProfil');

            // Validate required fields
            if (!form.checkValidity()) {
                form.reportValidity(); // This will highlight invalid fields and show default messages
                return; // Stop execution if the form is invalid
            }
            event.preventDefault();
            Swal.fire({
                title: "Kemaskini Profil",
                text: "Adakah anda pasti?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData(form);

                    fetch('controller/edit/edit_staff.php', {
                            method: 'POST',
                            body: new URLSearchParams(formData)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berjaya',
                                    text: data.message || 'Berjaya Kemaskini',
                                }).then(() => {
                                    window.location.href="staff.php";
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ralat',
                                    text: data.message || 'Ralat tidak diketahui',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Ralat',
                                text: 'Ralat memproses respons pelayan',
                            });
                        });
                }
            });
        }
    </script>

</body>

</html>