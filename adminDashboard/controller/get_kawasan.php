<?php
include 'connection.php';

if(isset($_POST['id_negeri']) && !empty($_POST['id_negeri'])) {
    $id_negeri = $_POST['id_negeri'];
    
    $sqlkawasan = "SELECT * FROM kawasan WHERE id_negeri = $id_negeri";
    $resultkawasan = mysqli_query($conn, $sqlkawasan);
    
    if(mysqli_num_rows($resultkawasan) > 0) {
        echo '<option disabled selected>--Pilih Kawasan--</option>';
        while($row = mysqli_fetch_assoc($resultkawasan)) {
            echo '<option value="' . $row['id_kaw'] . '">' . $row['nama_kaw'] . '</option>';
        }
    } else {
        echo '<option value="" disabled>No Kawasan available</option>';
    }
}
?>
