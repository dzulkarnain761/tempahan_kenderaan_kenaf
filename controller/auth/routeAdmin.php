
<?php

session_start();

// Check if the session 'kumpulan' is set, otherwise redirect to login
if (!isset($_SESSION['kumpulan'])) {
    header('Location: login.php');
    exit();
}

$kumpulan = $_SESSION['kumpulan'];

switch ($kumpulan) {
    case 'A':
        // Redirect to page for label2
        header('Location: ../../login.php');
        break;
    case 'B':
        // Redirect to page for label3
        header('Location: ../../login.php');
        break;
    case 'C':
        // Redirect to page for label3
        header('Location: ../../login.php');
        break;
    case 'D':
        // Redirect to page for label3
        header('Location: ../../login.php');
        break;
    case 'E':
        // Redirect to page for label3
        header('Location: ../../login.php');
        break;
    case 'F':
        // Redirect to page for label3
        header('Location: ../../login.php');
        break;
    case 'Y':
        // Redirect to page for label3
        header('Location: ../../login.php');
        break;
    case 'Z':
        // Redirect to admin page
        header('Location: ../../adminDashboard/dashboard.php');
        break;
    default:
        // Redirect to a default page if 'kumpulan' is not recognized
        header('Location: homepage.php');
        break;
}

exit();

?>
