<?php
include 'connection.php';


$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqlPemandu = "SELECT * FROM `pemandu` LIMIT $limit OFFSET $offset";
$resultPemandu = mysqli_query($conn, $sqlPemandu);

// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM `pemandu`";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

$pemanduData = [];
while ($row = mysqli_fetch_assoc($resultPemandu)) {
    $pemanduData[] = $row;
}

$response = [
    'data' => $pemanduData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);
