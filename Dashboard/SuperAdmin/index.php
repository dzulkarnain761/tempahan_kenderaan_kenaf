<!DOCTYPE html>
<html lang="en">
<?php include 'partials/head.php'; ?>

<body class="" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">
	<!-- Begin page -->

	<div class="wrapper">

		<?php include 'partials/left-sidemenu.php'; ?>

		<div class="content-page">
			<div class="content">
				<!-- Topbar Start -->

				<?php include 'partials/topbar.php'; ?>

				<!-- Start Content-->
				<div class="container-fluid">

					<!-- start page title -->
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">
								<h4 class="page-title">Dashboard</h4>
							</div>
						</div>
					</div>
					<!-- end page title -->

					<div class="row">
						<div class="col-sm-3">
							<div class="card widget-flat">
								<div class="card-body">
									<div class="float-end">
										<i class="uil uil-users-alt widget-icon"></i>
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Bilangan Pelanggan">Pelanggan</h5>
									<h3 class="mt-3 mb-3">36</h3>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="card widget-flat">
								<div class="card-body">
									<div class="float-end">
										<i class="uil uil-clipboard-alt widget-icon"></i>
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Bilangan Tempahan">Tempahan</h5>
									<h3 class="mt-3 mb-3">5</h3>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="card widget-flat">
								<div class="card-body">
									<div class="float-end">
										<i class="mdi mdi-cash-multiple widget-icon"></i>
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Jumlah Pendapatan">Pendapatan</h5>
									<h3 class="mt-3 mb-3">3</h3>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="card widget-flat">
								<div class="card-body">
									<div class="float-end">
										<i class="mdi mdi-account-group-outline widget-icon"></i>
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Pengguna yang sedang aktif">Pengguna Aktif</h5>
									<h3 class="mt-3 mb-3">6</h3>
								</div>
							</div>
						</div>
					</div> <!-- end row -->

					
					<div class="row">
						<div class="col-12">
							<div class="page-title-box">

								<h4 class="page-title">Tempahan</h4>
							</div>
						</div>
					</div>
					


					<div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Nama Pelanggan</th>
                                                    <th>Tarikh Tempahan</th>
                                                    <th>Status</th>   
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                require_once '../../Models/Tempahan.php';
                                                $tempahan = new Tempahan();
                                                $bookings = $tempahan->all();

                                                foreach ($bookings as $booking) { ?>
                                                    <tr>
                                                        <td><?php echo $booking['nama']; ?></td>
                                                        <td><?php echo $booking['created_at']; ?></td>     
                                                        <td><?php echo $booking['status_tempahan']; ?></td>
                                                        
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>

				</div>

			</div>
			<!-- content -->

			<?php include 'partials/footer.php'; ?>

		</div>

	</div>
	<!-- END wrapper -->

	<?php include 'partials/right-sidemenu.php'; ?>

	
	<?php include 'partials/script.php'; ?>

</body>

</html>