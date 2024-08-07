<?php
session_start();
session_unset();
session_destroy();
// Unset all of the session variables

header("Location: ../../login.php");
exit();
?>