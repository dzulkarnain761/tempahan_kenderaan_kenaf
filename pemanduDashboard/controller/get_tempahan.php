<?php
include 'connection.php';

session_start();

$pemandu_id = $_SESSION['id'];

$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqltempahan = "SELECT t.lokasi_kerja, t.luas_tanah, p.nama, tk.*, a.nama as nama_pemandu
                FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                LEFT JOIN admin a ON tk.pemandu_id = a.id
                WHERE t.status_tempahan = 'pengesahan pemandu' AND (tk.status_kerja = 'tempahan diproses' OR tk.status_kerja = 'dijalankan') AND tk.pemandu_id = $pemandu_id
                LIMIT $limit OFFSET $offset";
$resulttempahan = mysqli_query($conn, $sqltempahan);


// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM tempahan t
                LEFT JOIN penyewa p ON p.id = t.penyewa_id
                LEFT JOIN tempahan_kerja tk ON tk.tempahan_id = t.tempahan_id
                LEFT JOIN admin a ON tk.pemandu_id = a.id
                WHERE t.status_tempahan = 'pengesahan pemandu' AND (tk.status_kerja = 'tempahan diproses' OR tk.status_kerja = 'dijalankan') AND tk.pemandu_id = $pemandu_id";
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
