<?php
require_once '../../Models/Database.php';
$conn = Database::getConnection();

session_start();

// Dapatkan alamat IP pengguna
$ip_address = $_SERVER['REMOTE_ADDR'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['no_kp']) && !empty($_POST['password'])) {

        $no_kp = $_POST['no_kp'];
        $password = $_POST['password'];

        if (!ctype_digit($no_kp)) {
            echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda."]);
            exit();
        }

        // Fetch the user record based on no_kp
        $sqlLogin = "SELECT * FROM penyewa WHERE no_kp = ?";
        $stmt = $conn->prepare($sqlLogin);
        $stmt->bind_param('s', $no_kp);
        $stmt->execute();
        $resultLogin = $stmt->get_result();

        // Fetch the admin record based on no_kp
        $sqlAdminLogin = "SELECT * FROM admin WHERE no_kp = ?";
        $stmtAdmin = $conn->prepare($sqlAdminLogin);
        $stmtAdmin->bind_param('s', $no_kp);
        $stmtAdmin->execute();
        $adminLogin = $stmtAdmin->get_result();

        if ($resultLogin->num_rows > 0) {
            while ($rowLogin = $resultLogin->fetch_assoc()) {
                $hashed_password = $rowLogin['password'];
                $pengguna_id = $rowLogin['id'];
                $nama_pengguna = $rowLogin['nama'];
                $no_kp = $rowLogin['no_kp'];
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    // PENYEWA
                    $_SESSION['id'] = $pengguna_id;
                    $_SESSION['nama_pengguna'] = $nama_pengguna;
                    $_SESSION['no_kp'] = $no_kp;

                    echo json_encode(['success' => true, 'message' => 'Log Masuk Berjaya', 'location' => 'Dashboard/PENYEWA/profil.php']);
                    exit();
                } else {
                    echo json_encode(['success' => false, 'message' => 'Sila Pastikan Kata Laluan Anda']);
                    exit();
                }
            }
        } elseif ($adminLogin->num_rows > 0) {
            while ($rowAdmin = $adminLogin->fetch_assoc()) {
                $hashed_password = $rowAdmin['password'];
                $pengguna_id = $rowAdmin['id'];
                $nama_pengguna = $rowAdmin['nama'];
                $kumpulan = $rowAdmin['kumpulan'];
                $no_kp = $rowAdmin['no_kp'];
                
                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    // ADMIN
                    $_SESSION['kumpulan'] = $kumpulan;
                    $_SESSION['id'] = $pengguna_id;
                    $_SESSION['nama_pengguna'] = $nama_pengguna;
                    $_SESSION['no_kp'] = $no_kp;
                    

                    echo json_encode(['success' => true, 'message' => 'Log Masuk Berjaya', 'location' => 'controller/auth/routeAdmin.php']);
                    exit();
                } else {
                    echo json_encode(['success' => false, 'message' => 'Sila Pastikan Kata Laluan Anda']);
                    exit();
                }
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No Kad Pengenalan Belum Didaftar']);
            exit();
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No Kad Pengenalan dan Kata Laluan diperlukan.']);
        exit();
    }
}

?>
