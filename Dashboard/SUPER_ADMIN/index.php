<?php include 'controller/session.php'; ?>
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
										<i class="mdi mdi-account-multiple widget-icon"></i> <!-- Icon for staff -->
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Bilangan Staff">Bilangan Staff</h5>
									<h3 class="mt-3 mb-3"><?php
															require_once '../../Models/Admin.php';
															$staff = new Admin();
															$total_staffs = $staff->getTotalStaff();
															echo $total_staffs;
															?></h3>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="card widget-flat">
								<div class="card-body">
									<div class="float-end">
										<i class="mdi mdi-car widget-icon"></i> <!-- Icon for vehicles -->
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Bilangan Kenderaan">Bilangan Kenderaan</h5>
									<h3 class="mt-3 mb-3"><?php
															require_once '../../Models/Kenderaan.php';
															$kenderaan = new Kenderaan();
															$total_kenderaan = $kenderaan->getTotalKenderaan();
															echo $total_kenderaan;
															?></h3>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="card widget-flat">
								<div class="card-body">
									<div class="float-end">
										<i class="mdi mdi-clipboard-check widget-icon"></i> <!-- Icon for tasks -->
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Bilangan Tugasan">Bilangan Tugasan</h5>
									<h3 class="mt-3 mb-3"><?php
															require_once '../../Models/Tugasan.php';
															$tugasan = new Tugasan();
															$total_tugasan = $tugasan->getTotalTugasan();
															echo $total_tugasan;
															?></h3>
								</div>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="card widget-flat">
								<div class="card-body">
									<div class="float-end">
										<i class="mdi mdi-text-box-multiple-outline widget-icon"></i> <!-- Icon for bookings -->
									</div>
									<h5 class="text-muted fw-normal mt-0" title="Total Tempahan">Total Tempahan</h5>
									<h3 class="mt-3 mb-3"><?php
															require_once '../../Models/Tempahan.php';
															$tempahan = new Tempahan();
															$total_tempahan = $tempahan->getTotalTempahan();
															echo $total_tempahan;
															?></h3>
								</div>
							</div>
						</div>
					</div>



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
													<th>Tempahan ID</th>
													<th>Nama Pelanggan</th>
													<th>Tugasan</th>
													<th>Tarikh Tempahan</th>
													<th class="text-center">Status Tempahan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												require_once '../../Models/Tempahan.php';
												$tempahan = new Tempahan();
												$bookings = $tempahan->all();

												foreach ($bookings as $booking) { ?>
													<tr>
														<td><?php echo $booking['tempahan_id']; ?></td>
														<td><?php
															require_once '../../Models/Penyewa.php';
															$penyewa = new Penyewa();
															$user = $penyewa->findById($booking['penyewa_id']);
															echo $user['nama'];
															?></td>
														<td><?php
															require_once '../../Models/Kerja.php';
															$kerja = new Kerja();
															$works = $kerja->findByTempahanId($booking['tempahan_id']);
															$count = 1;
															foreach ($works as $work) {
																echo $count . '. ' . $work['nama_kerja'] . '<br>';
																$count++;
															}
															?></td>
														<td><?php echo date('d/m/Y, g:i A', strtotime($booking['created_at'])); ?></td>
														<td class="text-center">
                                                            <?php
                                                            $badgeColors = [
                                                                'dalam pengesahan' => 'secondary',
                                                                'belum bayar' => 'danger',
                                                                'bayaran diproses' => 'primary',
                                                                'selesai bayaran' => 'success',
                                                                'selesai' => 'success',
                                                                'refund' => 'warning',
                                                                'bayaran tambahan' => 'danger'
                                                            ];
                                                            $badgeColor = $badgeColors[$booking['status_bayaran']] ?? 'danger';
                                                            echo '<span class="badge bg-' . $badgeColor . '">' . strtoupper(htmlspecialchars($booking['status_bayaran'])) . '</span>';
                                                            ?>
                                                        </td>

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




	<?php include 'partials/script.php'; ?>

</body>

</html>