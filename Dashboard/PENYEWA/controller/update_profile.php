<?php

require_once '../../../Models/Database.php';
$conn = Database::getConnection();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $penyewa_id = intval($_POST['penyewa_id']);
    $nama = $_POST['nama'];
    $contact_no = $_POST['contact_no'];
    $alamat = $_POST['alamat'];
    $nama_bank = $_POST['nama_bank'];
    $no_bank = $_POST['no_bank'];
    $email = $_POST['email'];
   
    // Prepare and execute the first statement
    $sql1 = $conn->prepare("UPDATE penyewa SET nama = ?, contact_no = ?, alamat = ?, nama_bank = ?, no_bank = ?, email = ?  WHERE id = ?");
    $sql1->bind_param("ssssssi", $nama, $contact_no, $alamat, $nama_bank, $no_bank,$email, $penyewa_id);

    if (!$sql1->execute()) {
        echo json_encode(["success" => false, "message" => "Kemaskini Profil gagal: " . $sql1->error]);
        $sql1->close();
        $conn->close();
        exit;
    }
    $sql1->close();

    $conn->close();
    echo json_encode(["success" => true , "penyewa_id" => $penyewa_id]);
}
?>
