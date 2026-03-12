<?php
    session_start();
    $error_message = '';
    $sucess_message = '';

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
                        $sucess_message = "User added successfully.";
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <div id="dashboardMainConteiner">
            <?php require_once('../includes/sidebar.php'); ?>
            <div class="dashboard_content_conteiner" id="dashboard_content_conteiner">
                <?php require_once('../includes/nav.php') ?>
                <div class="dashboard_espaço">
                </div>
                <div class="dashboard_content">
                    <div id="dashboard_content_form">
                        <div class="row">
                            <div class="column column-4">
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
                                        <button><i class="bi bi-plus-lg"></i>Add User</button>
                                    </div>
                                </form>   
                            </div>
                            <div class="column column-6">
                                <h2 class="textTopList"><i class="bi bi-list-task"></i> User List</h2>
                                <div class="containerDashboardTable">
                                    <table class="dashboard_table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $stmt = $conn->query("SELECT id, first_name, last_name, email FROM dashboard_users ORDER BY id DESC ");
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "</tr>";
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="dashboard_content_footer"></div> -->
            </div>
        </div>
        <script src="../assets/scripts.js"></script>
        <?php require_once('../includes/popup.php'); ?>
    </body>
</html>