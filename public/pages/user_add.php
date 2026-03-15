<?php
    session_start();
    $error_message = '';
    $success_message = '';

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

                    if($result) {
                        $_SESSION['success_message'] = "User created successfully.";
                        header("Location: add_user.php");
                        exit();
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
        <title>Dashboard - Inventory Management System</title>
        <link rel="stylesheet" href="../CSS/styleDashboard.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <div id="dashboardMainConteiner">
            <?php require_once('../includes/sidebar.php'); ?>
            <div id="dashboard_content_conteiner">
                <?php require_once('../includes/nav.php') ?>
                <div class="dashboard_espaço">
                </div>
                <div class="dashboard_content">
                    <div id="dashboard_content_form">
                        <div class="row">
                            <div class="column">
                                <h2 class="textTopForm"><i class="bi bi-plus"></i> Create User</h2>
                                <form method="POST"  class="userForm">
                                    <div class="registerInputsConteiner">
                                        <label for="first_name">First name</label>
                                        <input type="text" id="first_name" placeholder="First name" name="first_name" required>
                                    </div>
                                    <div class="registerInputsConteiner">
                                        <label for="last_name">Last name</label>
                                        <input type="text" id="last_name" placeholder="Last name" name="last_name" required>
                                    </div>
                                    <div class="registerInputsConteiner">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" placeholder="Email" name="email" required>
                                    </div>
                                    <div class="registerInputsConteiner">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" placeholder="Password" name="password" required>
                                    </div>
                                    <div class="registerButtonConteiner">
                                        <button type="submit"><i class="bi bi-plus-lg"></i>Add User</button>
                                    </div>
                                </form>   
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="dashboard_content_footer"></div> -->
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <?php require_once('../includes/popup.php'); ?>

        <script src="../assets/scriptTableInterativa.js"></script>
        
        <script src="../assets/popupUser.js"></script>

        <script src="../assets/popupCrud.js"></script>

        <script src="../assets/scripts.js"></script>

        <script src="../assets/menuDashboard.js"></script>

        <!-- SweetAlert2 provides success and error messages when refreshing the page. -->
        <?php if (!empty($_SESSION['success_message'])): ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '<?= $_SESSION['success_message'] ?>',
                    confirmButtonText: 'OK'
                });
            </script>
            <?php unset($_SESSION['success_message']); endif; ?>

            <?php if (!empty($_SESSION['error_message'])): ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '<?= $_SESSION['error_message'] ?>',
                    confirmButtonText: 'OK'
                });
            </script>
            <?php unset($_SESSION['error_message']); endif; ?>
    </body>
</html>