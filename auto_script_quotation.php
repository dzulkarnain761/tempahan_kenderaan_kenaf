<?php
require_once 'Models/Database.php'; // Ensure this file exists and is correctly set up.

try {
    // Establish database connection
    $conn = Database::getConnection();

    // Update query
    $sql = "UPDATE quotation q
            LEFT JOIN tempahan t ON q.tempahan_id = t.tempahan_id
            SET q.status = 'dibatalkan',
                t.status_tempahan = 'dibatalkan',
                t.status_bayaran = 'dibatalkan',
                t.catatan = 'Tidak dibayar dalam masa 7 hari'
            WHERE q.status = 'belum bayar' AND q.end_date < NOW()";

    // Prepare and execute the query
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    echo "Status updated for expired quotations.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
