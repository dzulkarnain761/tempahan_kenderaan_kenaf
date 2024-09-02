<?php
include 'connection.php';


$limit = 5; // Number of entries to show per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// SQL query to select pemandu with pagination
$sqlstaff = "SELECT p.*, k.kump_desc 
                                    FROM `admin` p
                                    INNER JOIN `kumpulan` k ON p.kumpulan = k.kump_kod
                                    WHERE p.kumpulan NOT IN ('Y', 'Z') LIMIT $limit OFFSET $offset";
$resultstaff = mysqli_query($conn, $sqlstaff);




// Fetch total number of records
$sqlTotal = "SELECT COUNT(*) as total FROM `admin`";
$resultTotal = mysqli_query($conn, $sqlTotal);
$rowTotal = mysqli_fetch_assoc($resultTotal);
$total = $rowTotal['total'];
$totalPages = ceil($total / $limit);

$staffData = [];
while ($row = mysqli_fetch_assoc($resultstaff)) {
    $staffData[] = $row;
}

$response = [
    'data' => $staffData,
    'totalPages' => $totalPages,
    'currentPage' => $page
];

echo json_encode($response);




