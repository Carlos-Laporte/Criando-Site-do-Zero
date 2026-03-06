<?php
    session_start();
    $error_message = '';

    require_once('../configuration/connection.php');
    require_once('../authentication/guest.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$username]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            if(password_verify($password, $result['password'])){
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_email'] = $result['email'];
                $_SESSION['user_first_name'] = $result['first_name'];
                $_SESSION['user_last_name'] = $result['last_name'];
                
                header("Location: dashboard.php");
                exit();
            } else{
                $error_message = "incorrect password!";
            }
        } else{
            $error_message = "User not found!";
        }
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
    <?php
            if(!empty($error_message)){ ?>

                <div id="errorMessage">
                    <p>Error: <?= $error_message ?></p>
                </div>

    <?php   } ?>
    <div class="container">
        <div class="loginHeader">
            <h1>IMS</h1>
            <p>INVENTORY MANAGEMENT SYSTEM</p>
        </div>
        <div class="loginBody">
            <form action="login.php" method="POST">
                <div class="loginInputsConteiner">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="loginInputsConteiner">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="loginButtonConteiner">
                    <button>Login</button>
                </div>
            </form>
            <div class="loginCadastrar">
                    <a href="cadastro.php">Don't have an account yet?<strong>Sign up!</strong></a>
            </div>
        </div>
    </div>
</body>
</html>