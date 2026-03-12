<?php
    require_once('../configuration/connection.php');

    $id = $_POST['id'];
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($password)){

        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("
            UPDATE dashboard_users
            SET first_name=?, last_name=?, email=?, password=?
            WHERE id=?
        ");

        $stmt->execute([$first,$last,$email,$password,$id]);

    }else{

        $stmt = $conn->prepare("
            UPDATE dashboard_users
            SET first_name=?, last_name=?, email=?
            WHERE id=?
        ");

        $stmt->execute([$first,$last,$email,$id]);

    }

    echo "success";
?>