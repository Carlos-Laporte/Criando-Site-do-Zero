<?php
    session_start();

    require_once('../configuration/connection.php');

    if(isset($_SESSION['user_email'])){
        $email = $_SESSION['user_email'];
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            $_SESSION['user_first_name'] = $result['first_name'];
            $_SESSION['user_last_name'] = $result['last_name'];

            $full_name = $result['first_name'] . ' ' . $result['last_name'];
            $_SESSION['full_name'] = $full_name;
        }
    } else{
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard - Inventory Management System</title>
        <link rel="stylesheet" href="../CSS/styleDashboard.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div id="dashboardMainConteiner">
            <?php require_once('../includes/sidebar.php'); ?>
            <div class="dashboard_content_conteiner" id="dashboard_content_conteiner">
                <?php require_once('../includes/nav.php') ?>
                <div class="dashboard_espaço">
                </div>
                <div class="dashboard_content">
                    <div class="dashboard_content_main">
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/scripts.js"></script>
    </body>
</html>