<div class="dashboard_sidebar_d" id="dashboard_sidebar_i">
    <h3 class="dashboard_logo">IMS</h3>
    <div class="dashboard_sidebar_user">
        <img src="../img/image_perfil.jpg" alt="User image." id="userImage">
        <span><?= htmlspecialchars($full_name) ?></span>
    </div>
    <div class="dashboard_sidebar_user_menus">
        <ul class="dashboard_menu_lists">
            <li>
                <a href="../pages/dashboard.php" class="dashboard"><i class="bi bi-speedometer2"></i><span class="menuText">Dashboard</span></a>
            </li>
            <li>
                <a href="#" class="dropdown"><i class="bi bi-tag"></i><span class="menuText">Products</span><i class="bi bi-chevron-left arrow"></i></a>
                <ul class="submenu">
                    <li><a href="../pages/products_table.php"><i class="bi bi-circle"></i>View Products</a></li>
                    <li><a href="../pages/products_add.php"><i class="bi bi-circle"></i>Add Products</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown"><i class="bi bi-truck"></i><span class="menuText">Suppliers</span><i class="bi bi-chevron-left arrow"></i></a>
                <ul class="submenu">
                    <li><a href="../pages/suppliers_table.php"><i class="bi bi-circle"></i>View Suppliers</a></li>
                    <li><a href="../pages/suppliers_add.php"><i class="bi bi-circle"></i>Add Suppliers</a></li>
                </ul>
            </li>
            <li>
                <a href="#" class="dropdown"><i class="bi bi-person-add"></i></i><span class="menuText">Users</span><i class="bi bi-chevron-left arrow"></i></a>
                <ul class="submenu">
                    <li><a href="../pages/user_table.php"><i class="bi bi-circle"></i>Users Table</a></li>
                    <li><a href="../pages/user_add.php"><i class="bi bi-circle"></i>Users Add</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>