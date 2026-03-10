<?php
    session_start();
    $error_message = '';

    require_once('../configuration/connection.php');
    require_once('../authentication/guest.php');

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
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
                <div class="topIcon">
                    <span><i class="bi bi-lock-fill"></i></span>
                </div>
                <div class="topText">
                    <h2>Welcome Back!</h2>
                    <p>Login to your account to manage your inventory.</p>
                </div>
                <div class="loginInputsConteiner">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Email" name="email">
                </div>
                <div class="loginInputsConteiner">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="loginButtonConteiner">
                    <button>Login</button>
                </div>
                <div class="textIcons">
                    <div class="line"></div>
                    <div class="text">Or login with</div>
                    <div class="line"></div>
                </div>
                <div class="iconsLogin">
                    <a href="../oauth/google-login.php">
                        <i class="bi bi-google"></i>
                    </a>

                    <a href="../oauth/github-login.php">
                        <i class="bi bi-github"></i>
                    </a>

                    <a href="../oauth/facebook-login.php">
                        <i class="bi bi-facebook"></i>
                    </a>
                </div>
                <div class="loginCadastrar">
                    <a href="cadastro.php">Don't have an account yet?<strong>Sign up!</strong></a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>