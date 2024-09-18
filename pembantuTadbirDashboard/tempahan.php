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
	<link href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css" rel="stylesheet">
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

	<style>
	</style>
</head>

<body>
	<!-- =============== Navigation ================ -->
	<div class="custom-container">
		<?php
		include 'partials/navigation.php';
		?>

		<!-- ========================= Main ==================== -->
		<div class="main">
			<div class="topbar">
				<div class="toggle">
					<ion-icon name="menu-outline"></ion-icon>
				</div>

				<div class="userName">
					<div class="user-name">NAMA BINTI PENUH</div>
					<div class="user">
						<img src="../assets/images/user.png" alt="User Image">
					</div>
				</div>
			</div>

			<div class="recentOrders">
				<div class="cardHeader">
					<h2>STATUS PEMBAYARAN</h2>
				</div>

				<table class="table table-bordered table-hover" id="tempahanTable">
					<thead class="thead-dark">
						<tr>
							<th>No.</th>
							<th>Lokasi Kerja</th>
							<th>Senarai Kerja</th>
							<th>Tarikh Dicadangkan</th>
							<th>Status</th> <!-- New Status column -->
							<th>Tindakan</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>



				<!-- Pagination -->
				<nav aria-label="Page navigation">
					<ul class="pagination justify-content-start mt-4" id="pagination">
						<!-- Pagination links will be injected here by JavaScript -->
					</ul>
				</nav>

			</div>
		</div>

		<!-- =========== Scripts =========  -->
		<script src="../assets/js/main.js"></script>

		<!-- ====== ionicons ======= -->
		<script src="../vendor/sweetalert2-11.12.4/package/dist/sweetalert2.min.js"></script>
		<script src="../vendor/jquery/jquery-3.7.1.min.js"></script>
		<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
		<!-- <script src="assets/js/main.js"></script> -->
		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

		<script>
			function loadPage(page) {
				$.ajax({
					url: 'controller/get_tempahan.php', // The PHP file for fetching tempahan data
					type: 'GET',
					data: {
						page: page
					},
					dataType: 'json',
					success: function(response) {
						var tbody = $('#tempahanTable tbody');
						tbody.empty();

						var pagination = $('#pagination');
						pagination.empty(); // Clear pagination

						// Handle case when no data is found
						if (response.data.length === 0) {
							tbody.append(`
                    <tr>
                        <td colspan="6" class="text-center">Tiada Tempahan</td>
                    </tr>
                `);
							pagination.hide(); // Hide pagination if no data
						} else {
							pagination.show(); // Show pagination if data exists

							// Loop through each tempahan
							response.data.forEach(function(item, index) {
								var kerjaList = '';
								item.kerja.forEach(function(kerjaItem, kerjaIndex) {
									kerjaList += `
                            <tr>
                                ${kerjaIndex === 0 ? `<td rowspan="${item.kerja.length}">${index + 1}</td><td rowspan="${item.kerja.length}">${item.lokasi_kerja}</td>` : ''}
                                <td>${kerjaItem.nama_kerja}</td>
                                <td>${kerjaItem.tarikh_kerja_cadangan}</td>
                                ${kerjaIndex === 0 ? `<td rowspan="${item.kerja.length}">${item.status}</td>` : ''}
                                ${kerjaIndex === 0 ? `
                                <td rowspan="${item.kerja.length}">
                                    <button class="btn btn-primary btn-sm" onclick="window.open('controller/getPDF.php?id=${item.tempahan_id}', '_blank')">
                                        Lihat Butiran
                                    </button>
                                    <button class="btn btn-success btn-sm startKerja" value="${item.tempahan_id}">Mula Kerja</button>
                                </td>` : ''}
                            </tr>
                        `;
								});

								// Append the kerjaList to the table body
								tbody.append(kerjaList);
							});

							// Pagination logic
							if (response.totalPages > 1) {
								// Previous button
								pagination.append(`
                        <li class="page-item ${response.currentPage === 1 ? 'disabled' : ''}">
                            <a class="page-link" href="#" onclick="loadPage(${response.currentPage - 1})"><</a>
                        </li>
                    `);

								// Page numbers loop (ensure it runs when totalPages > 1)
								for (var i = 1; i <= response.totalPages; i++) {
									pagination.append(`
                            <li class="page-item ${i === response.currentPage ? 'active' : ''}">
                                <a class="page-link" href="#" onclick="loadPage(${i})">${i}</a>
                            </li>
                        `);
								}

								// Next button
								pagination.append(`
                        <li class="page-item ${response.currentPage === response.totalPages ? 'disabled' : ''}">
                            <a class="page-link" href="#" onclick="loadPage(${response.currentPage + 1})">></a>
                        </li>
                    `);
							} else {
								pagination.hide(); // Hide pagination if there's only 1 page
							}
						}
					}
				});
			}

			// Load the first page by default
			loadPage(1);


			$(document).on('click', '.startKerja', function(e) {
				let tempahanId = $(this).attr('value');

				Swal.fire({
					title: "Mula Kerja",
					text: "Anda tidak akan dapat membatalkan ini!",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "Ya"
				}).then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							url: 'controller/startKerja.php',
							type: 'POST',
							data: {
								id: tempahanId
							},
							success: function(response) {
								let res = JSON.parse(response);
								Swal.fire({
									title: "Berjaya",
									text: "Tempahan Dibatalkan",
									icon: "success"
								}).then(() => {
									window.location.reload();
								});
							},
							error: function(xhr, status, error) {
								Swal.fire({
									title: "Ralat!",
									text: "Ralat berlaku semasa mengemaskini status kerja.",
									icon: "error"
								});
							}
						});
					}
				});
			});
		</script>
	</div>
</body>

</html>