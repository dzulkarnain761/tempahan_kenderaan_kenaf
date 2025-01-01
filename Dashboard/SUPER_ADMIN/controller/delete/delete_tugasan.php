<?php

require_once '../../../../Models/Database.php';
$conn = Database::getConnection();

if (isset($_POST['tugasan_id'])) {
    // Dapatkan ID staff dari permintaan POST
    $tugasan_id = $_POST['tugasan_id'] ?? null;

    // Sediakan pernyataan SQL untuk penghapusan
    $sql = "DELETE FROM tugasan WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(['error' => 'Gagal menyediakan pernyataan SQL.']);
        exit;
    }

    // Ikat parameter dan laksanakan pernyataan
    $stmt->bind_param('i', $tugasan_id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(['success' => 'Tugasan berjaya dipadamkan.']);
        } else {
            echo json_encode(['error' => 'Tugasan tidak dijumpai.']);
        }
    } else {
        echo json_encode(['error' => 'Gagal menghapuskan staf.']);
    }

    // Tutup pernyataan dan sambungan
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['error' => 'Tiada ID disediakan.']);
}
?>
