
<?php

session_start();

$kumpulan = $_SESSION['kumpulan'];

switch ($kumpulan) {
    case 'A':
        // Redirect to page for label2
        header('Location: ../../Dashboard/KPP/tempahan.php');
        break;
    case 'B':
        // Redirect to page KETUA UNIT PEMBAIKIAN (KUP)
        header('Location: ../../kupDashboard/tempahan.php');
        break;
    case 'C':
        // Redirect to page for KETUA UNIT ASET (KUA)
        header('Location: ../../kuaDashboard/tempahan.php');
        break;
    case 'D':
        // Redirect to page for PEMBANTU EHWAL EKONOMI (PEE)
        header('Location: ../../Dashboard/PEE/tempahan.php');
        break;
    case 'E':
        // Redirect to page for KETUA PENGARAH
        header('Location: ../../Dashboard/PENGARAH/tempahan_resit.php');
        break;
    case 'F':
        // Redirect to page for PEMBANTU TADBIR
        header('Location: ../../Dashboard/PT/terima_tunai.php');
        break;
    case 'G':
        // Redirect to page for KEWANGAN
        header('Location: ../../Dashboard/KEWANGAN/tempahan.php');
        break;
    case 'Y':
        // Redirect to page for PEMANDU
        header('Location: ../../');
        break;
    case 'Z':
        // Redirect to SUPER ADMIN
        header('Location: ../../Dashboard/SUPER_ADMIN/index.php');
        break;
    case 'penyewa':
        // Redirect to SUPER ADMIN
        header('Location: ../../Dashboard/PENYEWA/homepage.php');
        break;
    default:
        header('Location: ../../Dashboard/PENYEWA/homepage.php');
        break;
}

exit();

?>
