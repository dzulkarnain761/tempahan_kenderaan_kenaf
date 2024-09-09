<?php
include 'connection.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    // Query to get the current 'kerja' data
    $sqlKerja = "SELECT * FROM tempahan_kerja WHERE id = $id";
    $resultKerja = mysqli_query($conn, $sqlKerja);

    if (mysqli_num_rows($resultKerja) > 0) {
        $row = mysqli_fetch_assoc($resultKerja);
        // Return only the value for harga_anggaran
        echo trim($row['harga_anggaran']);
    } else {
        echo 'not found';
    }
}
?>
