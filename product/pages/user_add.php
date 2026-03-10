<?php
    session_start();
    $error_message = '';

    require_once('../configuration/connection.php');

    //valida se o usuário está logado
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

    //recebe os dados do formulário de cadastro
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $firstName       = trim($_POST['first_name']);
        $lastName        = trim($_POST['last_name']);
        $email           = strtolower(trim($_POST['email']));
        $password        = trim($_POST['password']);
        $passwordConfirm = trim($_POST['password_confirm']);

        if (empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
            $error_message = "Please fill in all fields.";

        } else {
            $stmt = $conn->prepare("SELECT id FROM dashboard_users WHERE email = :email");
            $stmt->execute([':email' => $email]);
            if ($stmt->rowCount() > 0) {
                $error_message = "This email is already registered.";
            } 
            else {
                try {
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO dashboard_users (`first_name`, `last_name`, email, password) 
                            VALUES (:first_name, :last_name, :email, :password)";
                    $stmt = $conn->prepare($sql);
                    
                    $result = $stmt->execute([
                        ':first_name' => $firstName,
                        ':last_name'  => $lastName,
                        ':email'      => $email,
                        ':password'   => $hashedPassword
                    ]);
                    
    
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
        <title>Dashboard - Inventory Management System</title>
        <link rel="stylesheet" href="../CSS/styleDashboard.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    </head>
    <body>
        <div id="dashboardMainConteiner">
            <?php require_once('../includes/sidebar.php'); ?>
            <div class="dashboard_content_conteiner" id="dashboard_content_conteiner">
                <?php
                    if(!empty($error_message)) { ?>

                        <div id="errorMessage">
                            <p>Error: <?= htmlspecialchars($error_message) ?></p>
                        </div>

                <?php   } ?>
                <?php require_once('../includes/nav.php') ?>
                <div class="dashboard_espaço">
                </div>
                <div class="dashboard_content">
                    <div id="dashboard_content_form">
                        <form method="POST"  class="userForm">
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
                            <div class="registerButtonConteiner">
                                <button><i class="bi bi-plus-lg"></i>Add User</button>
                            </div>
                        </form>   
                    </div>
                </div>
                <div class="dashboard_content_footer">
                    
                </div>
            </div>
        </div>
        <script src="../assets/scripts.js"></script>
    </body>
</html>