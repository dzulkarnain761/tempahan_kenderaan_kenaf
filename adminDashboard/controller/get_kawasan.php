<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tempahan_kenderaan";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    //   die("Connection failed: " . mysqli_connect_error());
    echo json_encode(["success" => false, "message" => "Error: " . mysqli_connect_error()]);
}

if (isset($_POST['id_negeri']) && !empty($_POST['id_negeri'])) {
    $id_negeri = $_POST['id_negeri'];

    $sqlkawasan = "SELECT * FROM kawasan WHERE id_negeri = $id_negeri";
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
