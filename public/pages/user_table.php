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
                                <h2 class="textTopList"><i class="bi bi-list-task"></i> User List</h2>
                                <div class="containerDashboardTable">
                                    <table id="userTable" class="dashboard_table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $stmt = $conn->query("SELECT id, first_name, last_name, email, created_at, updated_at FROM dashboard_users ORDER BY id DESC ");
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                                                    echo "<td>" . htmlspecialchars($row['updated_at']) . "</td>";
                                                    $safeId    = htmlspecialchars($row['id'],         ENT_QUOTES);
                                                    $safeFirst = htmlspecialchars($row['first_name'], ENT_QUOTES);
                                                    $safeLast  = htmlspecialchars($row['last_name'],  ENT_QUOTES);
                                                    $safeEmail = htmlspecialchars($row['email'],      ENT_QUOTES);
                                                    echo "<td>
                                                                <button class='editBtn'
                                                                    data-id='{$safeId}'
                                                                    data-first='{$safeFirst}'
                                                                    data-last='{$safeLast}'
                                                                    data-email='{$safeEmail}'>
                                                                    <i class='bi bi-pencil-square'></i> Edit
                                                                </button>
                                                                <button class='deleteBtn'
                                                                    data-id='{$safeId}'>
                                                                    <i class='bi bi-trash'></i> Delete
                                                                </button>
                                                            </td>";
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

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

        <?php require_once('../includes/popup.php'); ?>

        <script src="../assets/scriptTableInterativa.js"></script>

        <script src="../assets/scriptPopupEdit.js"></script>

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