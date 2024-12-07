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
                                
                                <h4 class="page-title">Profil</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php

                                    $user_id = $_SESSION['id'];
                                    require_once '../../Models/Admin.php';
                                    $user = new Admin();
                                    $userdata = $user->findById($user_id);
                                    
                                    ?>
                                    
                                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                                        <div class="row mb-3">
                                            <label for="id" class="col-3 col-form-label">Staff ID</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="id" name="id" value="<?php echo $userdata['id']; ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="nama" class="col-3 col-form-label">Nama</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $userdata['nama']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="no_kp" class="col-3 col-form-label">No Kad Pengenalan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="no_kp" name="no_kp" value="<?php echo $userdata['no_kp']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="email" class="col-3 col-form-label">Email</label>
                                            <div class="col-9">
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $userdata['email']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="contact_no" class="col-3 col-form-label">No Panggilan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="contact_no" name="contact_no" value="<?php echo $userdata['contact_no']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="kumpulan" class="col-3 col-form-label">Kumpulan</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="kumpulan" name="kumpulan" value="<?php echo $userdata['kumpulan']; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="negeri" class="col-3 col-form-label">Negeri</label>
                                            <div class="col-9">
                                                <input type="text" class="form-control" id="negeri" name="negeri" value="<?php echo $userdata['negeri']; ?>" required>
                                            </div>
                                        </div>
                                        
                                    
                                        <div class="justify-content-end row">
                                            <div class="col-9">
                                                <button type="submit" class="btn btn-primary">Kemaskini</button>
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

</body>

</html>