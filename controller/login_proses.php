
<?php
include 'connection.php';
session_start();

// Dapatkan alamat IP pengguna
$ip_address = $_SERVER['REMOTE_ADDR'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nokp']) && !empty($_POST['password'])) {
        $nokp = $_POST['nokp'];
        $password = $_POST['password'];

		$nokplength = strlen($nokp);

		 if (strlen($nokp) < 14) {
            echo json_encode(["success" => false, "message" => "Sila Isi No Kad Pengenalan Yang Sah"]);
            exit();
        }

        // Fetch the user record based on nokp
        $sqlLogin = "SELECT * FROM pengguna WHERE no_kp = ?";
        $stmt = $conn->prepare($sqlLogin);
        $stmt->bind_param('s', $nokp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            while ($rowLogin = $result->fetch_assoc()) {
                $hashed_password = $rowLogin['password'];
                $kumpulan = $rowLogin['kumpulan'];
                $pengguna_id = $rowLogin['no_kp']; 
				$nama_pengguna = $rowLogin['nama'];
				
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    if ($kumpulan == 'G') {
                        $_SESSION['kumpulan'] = $kumpulan;
                        $_SESSION['pengguna_id'] = $pengguna_id;
						$_SESSION['nama_pengguna'] = $nama_pengguna;
						
                        // Rekod audit trail
                        $action = "Log masuk sebagai G";
                        $date_created = date('Y-m-d H:i:s');

                        // Simpan alamat IP pengguna dalam rekod logs
                        $sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES (?, ?, ?, ?)";
                        $stmtAudit = $conn->prepare($sqlAuditTrail);
                        $stmtAudit->bind_param('ssss', $pengguna_id, $action, $date_created, $ip_address);
                        $stmtAudit->execute();

						echo json_encode(['success' => true, 'message' => 'Log Masuk Berjaya']);
                        exit();
                    }

                } else {
                    echo json_encode(['success' => false, 'message' => 'Sila Pastikan Kata Laluan Anda']);
                }
            }

        } else {
            echo json_encode(['success' => false, 'message' => 'No Kad Pengenalan Belum Didaftar']);
        }
    } 
}

?>