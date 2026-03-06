<?php
    session_start();
    $error_message = '';

    require_once('../configuration/connection.php');
    require_once('../authentication/guest.php');

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $firstName       = trim($_POST['first_name']);
        $lastName        = trim($_POST['last_name']);
        $email           = strtolower(trim($_POST['email']));
        $password        = trim($_POST['password']);
        $passwordConfirm = trim($_POST['password_confirm']);

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($passwordConfirm)) {
            $error_message = "Please fill in all fields.";
        }

        elseif ($password !== $passwordConfirm) {
            $error_message = "Passwords do not match!";
        } 
        else {
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            if ($stmt->rowCount() > 0) {
                $error_message = "This email is already registered.";
            } 
            else {
                try {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO users (`first_name`, `last_name`, email, password) 
                            VALUES (:first_name, :last_name, :email, :password)";
                    $stmt = $conn->prepare($sql);
                    
                    $result = $stmt->execute([
                        ':first_name' => $firstName,
                        ':last_name'  => $lastName,
                        ':email'      => $email,
                        ':password'   => $hashedPassword
                    ]);
                    
                    if ($result) {
                        echo "DEBUG: Success! Redirecting...<br>";
                        header("Location: login.php");
                        exit();
                    } else {
                        $error_message = "Could not insert user.";
                    }
                } catch (PDOException $e) {
                    $error_message = "Database Error: " . $e->getMessage();
                }
            }
        }
    }
?>



<!DOCTYPE html>

<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>IMS Login - Inventory Management System</title>
        <link rel="stylesheet" href="../CSS/styleCadastro.css">
    </head>
    <body id="registerBody">
        <?php
            if(!empty($error_message)) { ?>

                <div id="errorMessage">
                    <p>Error: <?= htmlspecialchars($error_message) ?></p>
                </div>

        <?php   } ?>
        <div class="container">
            <div class="registerHeader">
                <h1>IMS</h1>
                <p>INVENTORY MANAGEMENT SYSTEM</p>
            </div>
            <div class="registerBody">
                <form action="cadastro.php" method="POST">
                    <div class="registerInputsConteiner">
                        <label for="first_name">First name</label>
                        <input type="text" placeholder="First name" name="first_name" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="last_name">Last name</label>
                        <input type="text" placeholder="Last name" name="last_name" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="email">Email</label>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="password">Password</label>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="password_confirm">Confirm your password</label>
                        <input type="password" placeholder="Password" name="password_confirm" required>
                    </div>
                    <div class="registerButtonConteiner">
                        <button>Register</button>
                    </div>
                </form>
                <div class="registerCadastrar">
                    <a href="../../index.php">Do you want to go back to the homepage? <strong>Click here!</strong></a>
                </div>
            </div>
        </div>
    </body>
</html>