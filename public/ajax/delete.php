<?php

    require_once('../configuration/connection.php');

    $id   = $_POST['id'];
    $page = $_POST['page'];

    if($page === "user"){
        $stmt = $conn->prepare("DELETE FROM dashboard_users WHERE id=?");
    }

    elseif($page === "products"){
        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    }

    $stmt->execute([$id]);

    echo "deleted";
?>