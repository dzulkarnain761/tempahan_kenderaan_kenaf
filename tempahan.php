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
	/* 
---------------------------------------------
content-wrapper
--------------------------------------------- 
*/

.header-area {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        .content-wrapper {
            margin-top: 100px; /* Adjust based on the height of your header */
            padding: 20px;
            border: 1px solid ;
            border-radius: 10px;
            max-width: 800px; /* Adjust width */
            margin: 50px auto; /* Center the content */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #C0C0C0;        
            background-color: ;
        }

        h2 {
            margin-bottom: 10px;
            font-size: 1.5rem;
        }

        h3 {
            margin-bottom: 10px;
            font-size: 1.3rem;
        }
		
		h4{
			margin-bottom: 10px;
            font-size: 1.0rem;
		}
	
        label, select {
            font-size: 1.2rem;
        }

        select {
            padding: 10px 15px;
            margin-top: 10px;
            border: 2px solid ;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #fff;
            width: 100%;
            max-width: 300px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            outline: none;
            transition: border-color 0.3s;
        }

        select:focus {
            border-color: #007bff;
        }


        .form-section {
            display: none;
            margin-top: 100px; /* Adjust based on the height of your header */
            padding: 20px;
            border: 1px solid ;
            border-radius: 10px;
            max-width: 600px; /* Adjust width */
            margin: 50px auto; /* Center the content */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #C0C0C0;        
        }
		
		.form-group{
			margin-top: 20px;
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
                        <a href="homepage.php" class="logo">
                            <img src="assets/images/logo.jpeg" alt="" style="width: 120px; height: auto;">
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="homepage.php">Laman Utama</a></li>
                            <li class="scroll-to-section"><a href="tempahan.php" class="active">Tempah</a></li>
                            <li class="scroll-to-section"><a href="sewaan.php">Sewaan</a></li>
                            <li class="scroll-to-section"><a href="bayaran.php">Bayaran</a></li>
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
        <h2>Sila Pilih</h2>
        <label for="sewa">Jenis Sewa:</label>
        <select id="sewa" name="sewa" required onchange="showForm()">
            <option value="" disabled selected>Sila Pilih Jenis Sewa</option>
            <option value="jam/harian">Per Jam/Harian</option>
            <option value="bulanan">Bulanan</option>
        </select>
	</div>
    <div id="form-jam-harian" class="form-section">
        <h3>Sewa Per Jam/Harian</h3>
		<form action="sewaan.php" method="POST">
            <div class="form-group">
                <label for="kerja">Jenis Kerja:</label>
                <select id="kerja" name="kerja" style="margin-left: 8px" required>
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
                <label for="jam">Jam:</label>
                <input type="number" id="jam" name="jam" style="margin-left: 67px" min="1" placeholder="Masukkan jumlah jam" required>
            </div>
            
            <div class="form-group">
                <label for="tarikh">Tarikh Mula:</label>
                <input type="date" id="tarikh" name="tarikh" required>
            </div>
			
			<div class="form-group">
                <label for="lokasiKerja">Lokasi Kerja:</label>
                <input type="text" id="lokasiKerja" name="lokasiKerja" min="1" placeholder="Masukkan lokasi kerja" required>   
            </div>
			
			<div class="form-group">
                <label for="keluasanTanah">Keluasan Tanah(Hektar):</label>
                <input type="number" id="keluasanTanah" name="keluasanTanah" min="1" placeholder="Masukkan keluasan tanah" required>   
            </div>
            
            <button type="submit">Hantar</button>
        </form>
    </div>

    <!-- Form for Bulanan -->
    <div id="form-bulanan" class="form-section">
        <h3>Sewa Bulanan</h3>
		<form action="sewaan.php" method="POST">
            <div class="form-group">    

                <label for="tarikh-mula">Tarikh Mula:</label>
                <input type="date" id="tarikh-mula" name="tarikh-mula" style="margin-left: 27px" required>
            </div>
            
            <div class="form-group">
                <label for="tempoh">Tempoh Sewa:</label>
                <input type="number" id="tempoh" name="tempoh" min="1" placeholder="Masukkan tempoh sewaan" required>   
            </div>
            
			<div class="form-group">
                <label for="lokasiKerja">Lokasi Kerja:</label>
                <input type="text" id="lokasiKerja" name="lokasiKerja" min="1" placeholder="Masukkan lokasi kerja" required>   
            </div>
			
			<div class="form-group">
                <label for="keluasanTanah">Keluasan Tanah(Hektar):</label>
                <input type="number" id="keluasanTanah" name="keluasanTanah" min="1" placeholder="Masukkan keluasan tanah" required>   
            </div>
	
            <button type="submit">Hantar</button>
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
