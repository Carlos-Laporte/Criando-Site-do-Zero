<?php
    session_start();
    session_unset();
    session_destroy();
    $full_name = $_SESSION['full_name'];

    header("Location: login.php");
    exit();
?>