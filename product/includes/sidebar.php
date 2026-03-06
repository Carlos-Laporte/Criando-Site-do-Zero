<div class="dashboard_sidebar" id="dashboard_sidebar">
    <h3 class="dashboard_logo">IMS</h3>
    <div class="dashboard_sidebar_user">
        <img src="../img/image_perfil.jpg" alt="User image." id="userImage">
        <span><?= htmlspecialchars($full_name) ?></span>
    </div>
    <div class="dashboard_sidebar_user_menus">
        <ul class="dashboard_menu_lists">
            <li>
                <a href="../pages/dashboard.php"><i class="bi bi-speedometer2"></i><span class="menuText">Dashboard</span></a>
            </li>
            <li>
                <a href="../pages/user_add.php"><i class="bi bi-person-fill-add"></i></i><span class="menuText">Add user</span></a>
            </li>
        </ul>
    </div>
</div>