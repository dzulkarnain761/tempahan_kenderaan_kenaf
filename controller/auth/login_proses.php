<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
    exit();
}

session_start();

// Dapatkan alamat IP pengguna
$ip_address = $_SERVER['REMOTE_ADDR'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nokp']) && !empty($_POST['kataLaluan'])) {

        $nokp = $_POST['nokp'];
        $password = $_POST['kataLaluan'];

        if (!ctype_digit($nokp)) {
            echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda."]);
            exit();
        }

        // Fetch the user record based on nokp
        $sqlLogin = "SELECT * FROM penyewa WHERE no_kp = ?";
        $stmt = $conn->prepare($sqlLogin);
        $stmt->bind_param('s', $nokp);
        $stmt->execute();
        $resultLogin = $stmt->get_result();

        // Fetch the admin record based on nokp
        $sqlAdminLogin = "SELECT * FROM admin WHERE no_kp = ?";
        $stmtAdmin = $conn->prepare($sqlAdminLogin);
        $stmtAdmin->bind_param('s', $nokp);
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

                    // Rekod audit trail
                    $action = "Log masuk sebagai PENYEWA";
                    $date_created = date('Y-m-d H:i:s');

                    // Simpan alamat IP pengguna dalam rekod logs
                    $sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES (?, ?, ?, ?)";
                    $stmtAudit = $conn->prepare($sqlAuditTrail);
                    $stmtAudit->bind_param('ssss', $pengguna_id, $action, $date_created, $ip_address);
                    $stmtAudit->execute();

                    echo json_encode(['success' => true, 'message' => 'Log Masuk Berjaya', 'location' => 'penyewaDashboard/homepage.php']);
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
                $negeri = $rowAdmin['negeri'];

                // Verify the password
                if (password_verify($password, $hashed_password)) {
                    // ADMIN
                    $_SESSION['kumpulan'] = $kumpulan;
                    $_SESSION['id'] = $pengguna_id;
                    $_SESSION['nama_pengguna'] = $nama_pengguna;
                    $_SESSION['no_kp'] = $no_kp;
                    $_SESSION['negeri'] = $negeri;

                    // Rekod audit trail
                    $action = "Log masuk sebagai ADMIN ($kumpulan)";
                    $date_created = date('Y-m-d H:i:s');

                    // Simpan alamat IP pengguna dalam rekod logs
                    $sqlAuditTrail = "INSERT INTO logs (pengguna_id, action, date_created, ip_address) VALUES (?, ?, ?, ?)";
                    $stmtAudit = $conn->prepare($sqlAuditTrail);
                    $stmtAudit->bind_param('ssss', $pengguna_id, $action, $date_created, $ip_address);
                    $stmtAudit->execute();

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
