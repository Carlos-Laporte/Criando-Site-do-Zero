<?php
    $error_message = '';
    
    if($_POST){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        include('../database/connection.php');
    }

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMS Login - Inventory Management System</title>
    <link rel="stylesheet" href="../CSS/styleLogin.css">
</head>
<body id="loginBody">
    <div>
        <p>Error: <?= $error_message ?></p>
    </div>
    <div class="container">
        <div class="loginHeader">
            <h1>IMS</h1>
            <p>INVENTORY MANAGEMENT SYSTEM</p>
        </div>
        <div class="loginBody">
            <form action="login.php" method="POST">
                <div class="loginInputsConteiner">
                    <label for="">Username</label>
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="loginInputsConteiner">
                    <label for="">Password</label>
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="loginButtonConteiner">
                    <button>Login</button>
                </div>
            </form>
            <div class="loginCadastrar">
                    <a href="../cadastro.php">Don't have an account yet?<strong>Sign up!</strong></a>
            </div>
        </div>
    </div>
</body>
</html>