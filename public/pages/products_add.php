<?php
    session_start();
    $error_message = '';
    $success_message = '';
    $created_by = $_SESSION['user_id'];

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

        $productName     = trim($_POST['product_name']);
        $codigoProduct   = trim($_POST['codigo']);
        $messageArea     = trim($_POST['comment']);

        if (empty($productName)) {
            $error_message = "Please fill in all fields.";

        } else {
            $stmt = $conn->prepare("SELECT codigo FROM products WHERE codigo = :codigo");
            $stmt->execute([':codigo' => $codigoProduct]);
            if ($stmt->rowCount() > 0) {
                $error_message = "This product is already registered.";
            } 
            else {
                try {

                    $sql = "INSERT INTO products (`product_name`, `codigo`, comment, created_by) 
                            VALUES (:product_name, :codigo, :comment, :created_by)";
                    $stmt = $conn->prepare($sql);
                    
                    $result = $stmt->execute([
                        ':product_name' => $productName,
                        ':codigo'       => $codigoProduct,
                        ':comment'      => $messageArea,
                        ':created_by'   => $created_by
                    ]);

                    if($result) {
                        $_SESSION['success_message'] = "Product created successfully.";
                        header("Location: products_add.php");
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
                                <h2 class="textTopForm"><i class="bi bi-plus"></i> Add Product</h2>
                                <form method="POST"  class="userForm">
                                    <div class="registerInputsConteiner">
                                        <label for="product_name">Product name</label>
                                        <input type="text" id="product_name" placeholder="Product name" name="product_name" required>
                                    </div>
                                    <div class="registerInputsConteiner">
                                        <label for="codigo">Product Code</label>
                                        <input type="text" id="codigo" placeholder="Product Code" name="codigo" required>
                                    </div>
                                    <div class="registerAreatextConteiner">
                                        <label for="comment">Product Information</label>
                                        <textarea type="comment" id="comment" placeholder="Product Information" name="comment" required></textarea>
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

        <script src="../assets/popupProduct.js"></script>

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