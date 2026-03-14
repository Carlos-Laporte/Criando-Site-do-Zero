<?php

    require_once('../configuration/connection.php');

    $id = $_POST['id'];

    $stmt = $conn->prepare("
        DELETE FROM dashboard_users
        WHERE id=?
    ");

    $stmt->execute([$id]);

    echo "deleted";
?>