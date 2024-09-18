<?php

session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'A') {
    header("Location: ../login.php");
    exit();
}

?>