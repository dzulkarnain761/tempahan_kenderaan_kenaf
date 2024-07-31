<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
include 'connection.php';
session_start();

// Dapatkan alamat IP pengguna
$ip_address = $_SERVER['REMOTE_ADDR'];


if (isset($_POST['submit'])) {
	$uname = $_POST['uname'];
	$passw = $_POST['passw'];

	//encrypted password
	$passw = md5($passw);

	$sqlLogin = "SELECT * FROM pengguna WHERE uname = '$uname' AND passw = '$passw'";
	$resLogin = mysqli_query($conn, $sqlLogin);

	$num_row = mysqli_num_rows($resLogin);

	if ($num_row > 0) {
		while ($rowLogin = mysqli_fetch_assoc($resLogin)) {

			$refno  = $rowLogin['refno'];
			$kumpulan = $rowLogin['kumpulan'];

			if ($kumpulan == 'G') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai G";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);


				header('location:index.php');
			}

			if ($kumpulan == 'K') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai K";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}

			if ($kumpulan == 'H') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai H";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}

			if ($kumpulan == 'J') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai J";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}
			if ($kumpulan == 'F') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai F";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}
			if ($kumpulan == 'E') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai E";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}
			if ($kumpulan == 'D') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai D";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}
			if ($kumpulan == 'C') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai C";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}
			if ($kumpulan == 'B') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai B";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}
			if ($kumpulan == 'A') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai A";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}

			if ($kumpulan == 'L') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai L";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}

			if ($kumpulan == 'N') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai N";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}

			if ($kumpulan == 'M') {
				$_SESSION['refno'] = $refno;
				$_SESSION['kumpulan'] = $kumpulan;

				// Rekod audit trail
				$pengguna_id = $refno;
				$action = "Log masuk sebagai M";
				$date_created = date('Y-m-d H:i:s');

				// Simpan alamat IP pengguna dalam rekod logs
				$sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES ('$pengguna_id', '$action', '$date_created', '$ip_address')";
				mysqli_query($conn, $sqlAuditTrail);

				header('location:index.php');
			}
		}
	} else {
		//echo 'slah';
?>

		<script>
			$(document).ready(function() {
				swal({
						title: "Daftar Masuk",
						text: "Daftar Masuk Tidak Berjaya! Sila Cuba Lagi.",
						icon: "warning",
						button: "Ok",
						closeOnClickOutside: false
					})
					.then(function() {
						window.location = "login.php";
					})
			});
		</script>
	<?php
	}

	?>

<?php
}

?>