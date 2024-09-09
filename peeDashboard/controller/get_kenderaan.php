<?php
include 'connection.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    // Query to get the current 'kerja' data
    $sqlKerja = "SELECT * FROM tempahan_kerja WHERE id = $id";
    $resultKerja = mysqli_query($conn, $sqlKerja);

    // Query to get all 'kenderaan' data
    $sqlkenderaan = "SELECT * FROM kenderaan";
    $resultkenderaan = mysqli_query($conn, $sqlkenderaan);

    // Check if the 'kenderaan' table has any data
    if (mysqli_num_rows($resultkenderaan) > 0) {
        // Fetch the related 'kerja' row
        $rowKerja = mysqli_fetch_assoc($resultKerja);

        // Get the current vehicle value if exists
        $currentValue = $rowKerja['no_pendaftaran_kenderaan'];

        // If there is no selected vehicle, show a placeholder option
        if ($rowKerja['no_pendaftaran_kenderaan'] == null) {
            echo '<option disabled selected value="">--Pilih kenderaan--</option>';
        }

        // Loop through the 'kenderaan' options and mark the current one as selected
        while ($row = mysqli_fetch_assoc($resultkenderaan)) {
            $selected = ($row['no_pendaftaran'] == $currentValue) ? 'selected' : '';
            echo '<option value="' . $row['no_pendaftaran'] . '" ' . $selected . '>' . $row['no_pendaftaran'] . ' - ' . $row['kategori_kenderaan'] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No kenderaan available</option>';
    }
}
