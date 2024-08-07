
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
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['nokp'])) {

        $nokp = $_POST['nokp'];

        if (empty($nokp) || !ctype_digit($nokp)) {
            echo json_encode(["success" => false, "message" => "Sila pastikan No Kad Pengenalan Anda."]);
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

                //PENYEWA
                if ($kumpulan == 'X') {
                    echo json_encode(['success' => true, 'message' => 'No Kad Pengenalan Dijumpai', 'nokp' => $pengguna_id]);
                    exit();
                }

                //SUPER ADMIN 
                if ($kumpulan == 'Z') {
                    echo json_encode(['success' => true, 'message' => 'No Kad Pengenalan Dijumpai']);
                    exit();
                }

            }
        } else {
            echo json_encode(['success' => false, 'message' => 'No Kad Pengenalan Belum Didaftar']);
        }
    }
}

?>