<?php
include 'connection.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $sqlkawasan = "SELECT * FROM admin WHERE kumpulan = 'Y'";
    $resultkawasan = mysqli_query($conn, $sqlkawasan);

    if (mysqli_num_rows($resultkawasan) > 0) {
        echo '<option disabled selected value="">--Pilih Kawasan--</option>';
        while ($row = mysqli_fetch_assoc($resultkawasan)) {
            echo '<option value="' . $row['nama_kaw'] . '">' . $row['nama_kaw'] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No Kawasan available</option>';
    }
}