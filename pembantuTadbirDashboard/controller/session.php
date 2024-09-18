<?php

session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'F') {
    header("Location: ../login.php");
    exit();
}

?>