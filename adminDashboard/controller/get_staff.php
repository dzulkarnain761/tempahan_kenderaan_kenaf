<?php
include 'connection.php';


$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqlPengguna = "SELECT * FROM `pengguna` LIMIT $limit OFFSET $offset";
$resultPengguna = mysqli_query($conn, $sqlPengguna);

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM `pengguna`";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

$penggunaData = [];
while ($row = mysqli_fetch_assoc($resultPengguna)) {
    $penggunaData[] = $row;
}

$response = [
    'data' => $penggunaData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);
