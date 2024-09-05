<?php
include 'connection.php';

if (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = $_POST['id'];

    $sqlKerja = "SELECT * FROM tempahan_kerja WHERE id = $id";
    $resultKerja = mysqli_query($conn, $sqlKerja);

    if (mysqli_num_rows($resultKerja) > 0) {
        while ($row = mysqli_fetch_assoc($resultKerja)) {
            echo '
                <label for="nama_kerja" class="form-label">Nama Kerja</label>
                <input type="text" id="nama_kerja" name="nama_kerja" class="form-control" value="' . $row['nama_kerja'] . ' " readonly>';
        }
    } else {
        echo '<input type="text" id="nama_kerja" name="nama_kerja" value="not found">';
    }
}
