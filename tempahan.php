<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Booking</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/tempahan.css">
    <link rel="stylesheet" href="assets/css/animated.css">
    <link rel="stylesheet" href="assets/css/owl.css">
	<style>
	label {
		font-size: 20px;
	}
	</style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="tempahan.php" class="logo">
                            <img src="assets/images/logo2.png" alt="logoLKTN" style="width: 70px; height: auto;">
							<img src="assets/images/logo.jpeg" alt="" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php" class="active">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="bayaran.php">Bayaran</a></li>
							<li class="scroll-to-section"><a href="profil.php">Profil</a></li>
                            <li class="scroll-to-section">
                                <div class="border-first-button"><a href="login.php">Logout</a></div>
                            </li>
                        </ul>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Content Start ***** -->
    <div class="content-wrapper" data-wow-duration="0.75s" data-wow-delay="0s">
        <h4 style="font-weight: bold; margin-top:15px; text-transform: uppercase;">Sila Pilih</h4>
        <label for="sewa">Jenis Sewa :</label>
        <select id="sewa" name="sewa" required onchange="showForm()" style="margin-left: 150px">
            <option value="" disabled selected>Sila Pilih Jenis Sewa</option>
            <option value="jam/harian">Per Jam/Harian</option>
            <option value="bulanan">Bulanan</option>
        </select>
	</div>
    <div id="form-jam-harian" class="form-section">
        <h4 style="margin-top:15px; font-weight:bold; text-transform: uppercase;">Sewa Per Jam/Harian</h4>
		<form action="sewaan.php" method="POST">
            <div class="form-group">
                <label for="kerja">Jenis Kerja :</label>
                <select id="kerja" name="kerja" style="margin-left: 150px; margin-bottom:10px;" required>
                    <option value="" disabled selected>Sila Pilih Jenis Kerja</option>
                    <option value="piring">Piring</option>
                    <option value="piringBatasBesar">Piring Batas Besar</option>
                    <option value="rotor1">Rotor 1</option>
                    <option value="rotor2">Rotor 2</option>
                    <option value="menanamKenaf">Menanam Kenaf</option>
                    <option value="rotorRidger">Rotor Ridger</option>
                    <option value="meracun">Meracun</option>
                    <option value="memotong/menebangKenaf">Memotong / Menebang Kenaf</option>
                    <option value="khidmatTrailer">Khidmat Trailer</option>
                    <option value="mengapur/membaja">Mengapur / Membaja (Manure Spreader)</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="jam">Jam :</label>
                <input type="number" id="jam" name="jam" style="margin-left: 210px" min="1" placeholder="Masukkan jumlah jam" required>
            </div>
            
            <div class="form-group">
                <label for="tarikh">Tarikh Mula :</label>
                <input type="date" id="tarikh" name="tarikh" style="margin-left: 140px;" required>
            </div>
			
			<div class="form-group">
                <label for="lokasiKerja">Lokasi Kerja :</label>
                <input type="text" id="lokasiKerja" name="lokasiKerja"  style="margin-left: 138px;" min="1" placeholder="Masukkan lokasi kerja" required>   
            </div>
			
			<div class="form-group">
                <label for="keluasanTanah">Keluasan Tanah (Hektar) :</label>
                <input type="number" id="keluasanTanah" name="keluasanTanah"  style="margin-left: 9px;" min="1" placeholder="Masukkan keluasan tanah" required>   
            </div>
            <div class="container">
				<button type="submit" class="styled-button" style="margin-left: 650px;">Hantar</button>
			</div>
        </form>
    </div>

    <!-- Form for Bulanan -->
    <div id="form-bulanan" class="form-section">
        <h4 style="margin-top:15px; font-weight:bold; text-transform: uppercase;">Sewa Bulanan</h4>
		<form action="sewaan.php" method="POST">
            <div class="form-group">    

                <label for="tarikh-mula">Tarikh Mula :</label>
                <input type="date" id="tarikh-mula" name="tarikh-mula" style="margin-left: 150px" required>
            </div>
            
            <div class="form-group">
                <label for="tempoh">Tempoh Sewa :</label>
                <input type="number" id="tempoh" name="tempoh" min="1" style="margin-left: 120px" placeholder="Masukkan tempoh sewaan" required>   
            </div>
            
			<div class="form-group">
                <label for="lokasiKerja">Lokasi Kerja :</label>
                <input type="text" id="lokasiKerja" name="lokasiKerja" min="1" style="margin-left: 147px" placeholder="Masukkan lokasi kerja" required>   
            </div>
			
			<div class="form-group">
                <label for="keluasanTanah">Keluasan Tanah (Hektar) :</label>
                <input type="number" id="keluasanTanah" name="keluasanTanah" style="margin-left: 10px" min="1" placeholder="Masukkan keluasan tanah" required>   
            </div>
	
            <button type="submit" class="styled-button" style="margin-left: 650px;">Hantar</button>
        </form>
    </div>
   
    <!-- ***** Content End ***** -->

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/animation.js"></script>
    <script src="assets/js/imagesloaded.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        function showForm() {
            var sewa = document.getElementById("sewa").value;
            var formJamHarian = document.getElementById("form-jam-harian");
            var formBulanan = document.getElementById("form-bulanan");

            formJamHarian.style.display = "none";
            formBulanan.style.display = "none";

            if (sewa === "jam/harian") {
                formJamHarian.style.display = "block";
            } else if (sewa === "bulanan") {
                formBulanan.style.display = "block";
            }
        }
    </script>

</body>

</html>
