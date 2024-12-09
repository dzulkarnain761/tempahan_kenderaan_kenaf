<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $staff_id = $_POST['staff_id'];
    $nama_staff = $_POST['nama_staff'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $kumpulan_kod = $_POST['kumpulan_kod'];

    // Convert name to uppercase
    $fullname = strtoupper(trim($nama_staff));

    // Validate inputs
    if (empty($contact_no) || !ctype_digit($contact_no)) {
        echo json_encode(["success" => false, "message" => "Sila pastikan No Telefon Anda."]);
        exit();
    }

    

    // Prepare the SQL statement
    $sql = $conn->prepare("UPDATE admin SET nama = ?, contact_no = ?, email = ?, kumpulan = ? WHERE id = ?");
    if ($sql) {
        $sql->bind_param("sssss", $fullname, $contact_no, $email, $kumpulan_kod, $staff_id);

        if ($sql->execute()) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "message" => "Pendaftaran gagal."]);
        }

        $sql->close();
    } else {
        echo json_encode(["success" => false, "message" => "Penyataan SQL gagal disediakan."]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Permintaan tidak sah."]);
}
?>
