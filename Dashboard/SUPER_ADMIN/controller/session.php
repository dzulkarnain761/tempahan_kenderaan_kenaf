<?php

session_start();

if (!isset($_SESSION["kumpulan"]) || $_SESSION["kumpulan"] !== 'Z') {
    header("Location: ../login.php");
    exit();
}

?>