<?php
    require_once('../configuration/connection.php');

    $id   = $_POST['id'] ?? null;
    $page = $_POST['page'] ?? null;

    if(!$id || !$page){
        echo "error";
        exit;
    }

    if($page === "user"){

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

    }else if($page === "products"){
        $product  = $_POST['product_name'];
        $codigo   = $_POST['codigo'];
        $comment  = $_POST['comment'];

        $stmt = $conn->prepare("
        UPDATE products SET product_name=?, codigo=?, comment=?
        ");

        $stmt->execute([$product, $codigo, $comment]);

    }else if($page === "user"){

        $first = $_POST['supplier_name'];
        $last = $_POST['supplier_location'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("
            UPDATE dashboard_users
            SET first_name=?, last_name=?, email=?
            WHERE id=?
        ");

        $stmt->execute([$first,$last,$email,$id]);

    }else{
        echo "invalid page";
        exit;
    }

    echo "success";

?>