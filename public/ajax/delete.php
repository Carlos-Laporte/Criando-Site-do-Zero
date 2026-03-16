<?php

    require_once('../configuration/connection.php');

    $id   = $_POST['id'];
    $page = $_POST['page'];

    if($page === "users"){
        $stmt = $conn->prepare("DELETE FROM dashboard_users WHERE id=?");
    }

    else if($page === "products"){
        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
    }

    else if($page === "supplier"){
        $stmt = $conn->prepare("DELETE FROM supplier WHERE id=?");

    }else{
        echo "invalid_page";
        exit;
    }

    $stmt->execute([$id]);

    echo "deleted";
?>