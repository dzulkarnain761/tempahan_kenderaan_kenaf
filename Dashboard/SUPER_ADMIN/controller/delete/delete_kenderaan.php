<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();

if (isset($_POST['kenderaan_id'])) {
    // Dapatkan ID kenderaan dari permintaan POST
    $kenderaan_id = $_POST['kenderaan_id'] ?? null;

    // Sediakan pernyataan SQL untuk penghapusan
    $sql = "DELETE FROM kenderaan WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['error' => 'Gagal menyediakan pernyataan SQL.']);
        exit;
    }

    // Ikat parameter dan laksanakan pernyataan
    $stmt->bind_param('i', $kenderaan_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => 'Kenderaan berjaya dipadam.']);
        } else {
            echo json_encode(['error' => 'Kenderaan tidak dijumpai.']);
        }
    } else {
        echo json_encode(['error' => 'Gagal menghapuskan kenderaan.']);
    }

    // Tutup pernyataan dan sambungan
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Tiada ID disediakan.']);
}
?>
