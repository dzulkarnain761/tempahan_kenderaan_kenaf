<?php
include 'connection.php';

session_start();

$pemandu_id = $_SESSION['id'];

$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqltempahan = "SELECT t.lokasi_kerja,t.luas_tanah,tk.nama_kerja,tk.tarikh_kerja_cadangan,p.nama,p.contact_no,tk.status_kerja,j.*
                FROM jobsheet j
                LEFT JOIN tempahan t ON j.tempahan_id = t.tempahan_id
                LEFT JOIN tempahan_kerja tk ON j.tempahan_kerja_id = tk.tempahan_kerja_id
                LEFT JOIN admin a ON j.pemandu_id = a.id
                LEFT JOIN penyewa p ON t.penyewa_id = p.id
                WHERE t.status_tempahan = 'pengesahan pemandu' AND (j.status_jobsheet = 'dalam proses' OR j.status_jobsheet = 'dijalankan') AND j.pemandu_id = $pemandu_id
                LIMIT $limit OFFSET $offset";
$resulttempahan = mysqli_query($conn, $sqltempahan);


// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total 
                FROM jobsheet j
                LEFT JOIN tempahan t ON j.tempahan_id = t.tempahan_id
                LEFT JOIN tempahan_kerja tk ON j.tempahan_kerja_id = tk.tempahan_kerja_id
                LEFT JOIN admin a ON j.pemandu_id = a.id
                LEFT JOIN penyewa p ON t.penyewa_id = p.id
                WHERE t.status_tempahan = 'pengesahan pemandu' AND (j.status_jobsheet = 'dalam proses' OR j.status_jobsheet = 'dijalankan') AND j.pemandu_id = $pemandu_id";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

$tempahanData = [];
while ($row = mysqli_fetch_assoc($resulttempahan)) {
    $tempahanData[] = $row;
}

$response = [
    'data' => $tempahanData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);
