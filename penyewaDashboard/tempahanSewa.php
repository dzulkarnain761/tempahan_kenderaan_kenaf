<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>eBooking</title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo2.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/animated.css">
    <link rel="stylesheet" href="../assets/css/owl.css">

<style>
   
</style>
</head>

<body>

    <div class="container-custom">
		<h3 class="text-center fw-bold" style="margin-top: 15px; margin-bottom: 15px;">Tempahan</h3>

		<!--SELEPAS PENYEWA MEMBUAT TEMPAHAN-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status dalamPengesahan">Dalam Pengesahan</div>
				</div><br>

                <p><span class="semibold">Cadangan Tarikh Kerja : </span>
                <span>21/06/2024</span></p>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>

                    <span>
                        <button class="btn btn-danger btn-sm" type="button">Batal Kerja</button>
                    </span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>

                    <span>
                        <button class="btn btn-danger btn-sm" type="button">Batal Kerja</button>
                    </span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: flex-end; gap: 10px;">
					<span>
						<button class="btn btn-danger btn-sm" type="button">Batal Tempahan</button>
					</span>
					<span>
						<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
					</span>
				</div>
				
				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--SELEPAS PEE SAHKAN TEMPAHAN-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status dalamPengesahan">Dalam Pengesahan</div>
				</div><br>

                <p><span class="semibold">Cadangan Tarikh Kerja : </span>
                <span>21/06/2024</span></p>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: flex-end; gap: 10px;">
					<span>
						<button class="btn btn-danger btn-sm" type="button">Batal Tempahan</button>
					</span>
					<span>
						<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
					</span>
				</div>
				
				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--SELEPAS KPP SAHKAN TEMPAHAN (DITERIMA)-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status bayaranDeposit">Bayaran Deposit</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
					<!-- Left side: Link to Lihat Sebut Harga -->
					<span>
						<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
					</span>
					
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-danger btn-sm" type="button">Batal Tempahan</button>
						</span>
						<span>
							<button class="btn btn-success btn-sm" type="button">Bayar</button>
						</span>
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>
				</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--SELEPAS KPP SAHKAN TEMPAHAN (DITOLAK)-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status ditolak">Ditolak</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				
				<p><span class="semibold">Sebab Ditolak : </span>
                <span>Error</span></p>
				
				<hr>
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--SELEPAS PENYEWA MEMBUAT DEPOSIT-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status bayaranDeposit">Deposit diproses</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
					<!-- Left side: Link to Lihat Sebut Harga -->
					<span>
						<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
					</span>
					
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>
				</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--TEMPAHAN DIBATALKAN OLEH PENYEWA-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status ditolak">Dibatalkan</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				
				<p><span class="semibold">Sebab Dibatalkan : </span>
                <span>Error</span></p>
				
				<hr>
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
						<!-- Left side: Link to Lihat Sebut Harga -->
						<span>
							<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
						</span>
						<div style="display: flex; justify-content: flex-end; gap: 10px;">
							<span>
								<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
							</span>
						</div>
					</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--PT SAHKAN BAYARAN-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status selesai">Deposit selesai</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
					<!-- Left side: Link to Lihat Sebut Harga -->
					<span>
						<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
					</span>
					
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-success btn-sm" type="button">Resit</button>
						</span>
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>
				</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--PEMANDU MENERIMA KERJA-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status selesai">Deposit selesai</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    <span class="status bayaranDeposit">Dijalankan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    <span  class="status selesai">Selesai</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
					<!-- Left side: Link to Lihat Sebut Harga -->
					<span>
						<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
					</span>
					
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-success btn-sm" type="button">Resit</button>
						</span>
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>
				</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--SELEPAS SEMUA KERJA SELESAI-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status belum-bayar">Belum bayar</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    <span  class="status selesai">Selesai</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    <span  class="status selesai">Selesai</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
					<!-- Left side: Link to Lihat Sebut Harga -->
					<span>
						<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
					</span>
					
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-success btn-sm" type="button">Bayar</button>
						</span>
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>
				</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--SELEPAS PENYEWA MEMBUAT BAYARAN-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status bayaranDeposit">Bayaran diproses</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
					<!-- Left side: Link to Lihat Sebut Harga -->
					<span>
						<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
					</span>
					
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>
				</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
		<!--SELEPAS PT MENERIMA BAYARAN-->
		<div class="rental-list">
            <div class="rental-item">
                <div class="id">
                    Tempahan ID: 01
                    <div class="status selesai">Selesai</div>
				</div><br>
				
				<p><span class="semibold">Senarai Kerja : </span></p>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Bersih Kawasan</span>
                    </li>
                </ul>
				<ul>
                    <li style="display: flex; justify-content: space-between; align-items: center;">
                    <span>Baikpulih Kawasan</span>
                    </li>
                </ul>
				<hr>
				<div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
					<!-- Left side: Link to Lihat Sebut Harga -->
					<span>
						<a href="#" class="btn btn-link btn-sm" style="text-decoration: none; color: #007bff;">Lihat Sebut Harga</a>
					</span>
					
					<!-- Right side: Buttons (Batal Tempahan, Bayar, Lihat Butiran) -->
					<div style="display: flex; justify-content: flex-end; gap: 10px;">
						<span>
							<button class="btn btn-success btn-sm" type="button">Resit</button>
						</span>
						<span>
							<button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal">Lihat Butiran</button>
						</span>
					</div>
				</div>

				<?php include 'butiran.php'; ?>
            </div>    
		</div>
		
	</div>
	
	
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

</body>
</html>