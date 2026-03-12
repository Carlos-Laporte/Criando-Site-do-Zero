<?php
    session_start();
    $error_message = '';
    $success_message = '';

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
                        $success_message = "User registered successfully!";
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body id="registerBody">
        <div class="container">
            <div class="registerHeader">
                <h1>IMS</h1>
                <p>INVENTORY MANAGEMENT SYSTEM</p>
            </div>
            <div class="registerBody">
                <form action="cadastro.php" method="POST">
                    <div class="topIcon">
                        <i class="bi bi-person-fill-add"></i>
                    </div>
                    <div class="topRegister">
                        <h2>Create your account</h2>
                        <p>Enter your details to create an account.</p>
                    </div>
                    <div class="registerRow">
                        <div class="registerInputsConteiner">
                            <label for="first_name">First name</label>
                            <input type="text" id="first_name" placeholder="First name" name="first_name" required autocomplete="given-name">
                        </div>
                        <div class="registerInputsConteiner">
                            <label for="last_name">Last name</label>
                            <input type="text" id="last_name" placeholder="Last name" name="last_name" required autocomplete="family-name">
                        </div>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="email">Email</label>
                        <input type="email" id="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="password">Password</label>
                        <input type="password" id="password" placeholder="Password" name="password" required>
                    </div>
                    <div class="registerInputsConteiner">
                        <label for="password_confirm">Confirm your password</label>
                        <input type="password" id="password_confirm" placeholder="Password" name="password_confirm" required>
                    </div>
                    <div class="registerButtonConteiner">
                        <button>Register</button>
                    </div>
                    <div class="textIcons">
                        <div class="line"></div>
                        <div class="text">Or register with</div>
                        <div class="line"></div>
                    </div>
                    <div class="iconsCadastro">
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
                    <div class="registerCadastrar">
                        <p>Already have an account? <a href="login.php"><strong>Click here!</strong></a></p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Popup Messages -->
        <?php if(!empty($success_message)) { ?>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?= $success_message ?>',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    window.location.href = "login.php";
                });
            });
            </script>
        <?php } ?>

        <?php if(!empty($error_message)) { ?>
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?= $error_message ?>',
                    confirmButtonColor: '#d33'
                });
            });
            </script>
        <?php } ?>
    </body>
</html>