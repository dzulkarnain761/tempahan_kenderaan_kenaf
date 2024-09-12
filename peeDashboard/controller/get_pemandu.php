<?php
include 'connection.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    // Query to get the current 'kerja' data
    $sqlKerja = "SELECT * FROM tempahan_kerja WHERE id = $id";
    $resultKerja = mysqli_query($conn, $sqlKerja);

    // Query to get all 'pemandu' data
    $sqlpemandu = "SELECT * FROM admin where kumpulan = 'Y'";
    $resultpemandu = mysqli_query($conn, $sqlpemandu);

    // Check if the 'pemandu' table has any data
    if (mysqli_num_rows($resultpemandu) > 0) {
        // Fetch the related 'kerja' row
        $rowKerja = mysqli_fetch_assoc($resultKerja);

        // Get the current vehicle value if exists
        $currentValue = $rowKerja['nama_pemandu'];

        // If there is no selected vehicle, show a placeholder option
        if ($rowKerja['nama_pemandu'] == null) {
            echo '<option disabled selected value="">--Pilih pemandu--</option>';
        }

        // Loop through the 'pemandu' options and mark the current one as selected
        while ($row = mysqli_fetch_assoc($resultpemandu)) {
            $selected = ($row['nama'] == $currentValue) ? 'selected' : '';
            echo '<option value="' . $row['nama'] . '" ' . $selected . '>' . $row['nama'] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No pemandu available</option>';
    }
}
