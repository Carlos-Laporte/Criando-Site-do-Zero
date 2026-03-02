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
            <div class="dashboard_sidebar" id="dashboard_sidebar">
                <h3 class="dashboard_logo">IMS</h3>
                <div class="dashboard_sidebar_user">
                    <img src="../img/image_perfil.jpg" alt="User image." id="userImage">
                    <span>Gomez</span>
                </div>
                <div class="dashboard_sidebar_user_menus">
                    <ul class="dashboard_menu_lists">
                        <li>
                            <a href=""><i class="bi bi-speedometer2"></i><span class="menuText">Dashboard</span></a>
                        </li>
                        <li>
                            <a href=""><i class="bi bi-speedometer2"></i><span class="menuText">Dashboard</span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dashboard_content_conteiner" id="dashboard_content_conteiner">
                <div class="dashboard_topNav">
                    <a href="" class="list"><i class="bi bi-list"></i></a>
                    <a href="../../login.php" class="log-out"><i class="bi bi-power"></i> Log-out</a>
                </div>
                <div class="dashboard_content">
                    <div class="dashboard_content_main">

                    </div>
                </div>
            </div>
        </div>

        <script>
            const taggleBtn = document.querySelector(".list");

            const dashboard_sidebar = document.getElementById("dashboard_sidebar");
            const dashboard_content_conteiner = document.getElementById("dashboard_content_conteiner");
            const dashboard_logo = document.querySelector(".dashboard_logo");
            const userImage = document.getElementById("userImage");

            var sideBarIsOpen = true;

            taggleBtn.addEventListener('click', (event) => { event.preventDefault();

                if(sideBarIsOpen){
                    dashboard_sidebar.style.width = '18%';
                    dashboard_sidebar.style.transition = '0.5s all';
                    dashboard_content_conteiner.style.width = '80%';
                    userImage.style.width = '80px'; 
                    
                    menuIcons = document.getElementsByClassName('menuText');
                    for(var i=0; i< menuIcons.length; i++){
                        menuIcons[i].style.display = 'none';
                    }
                    
                    document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'center';
                    sideBarIsOpen = false;
                }else{
                    dashboard_sidebar.style.width = '25%';
                    dashboard_content_conteiner.style.width = '80%';
                    dashboard_logo.style.fontSize = '80px';
                    userImage.style.width = '80px'; 
                    
                    menuIcons = document.getElementsByClassName('menuText');
                    for(var i=0; i< menuIcons.length; i++){
                        menuIcons[i].style.display = 'inline-block';
                    }
                    
                    document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'left';
                    sideBarIsOpen = true;
                }
               
            });
        </script>
    </body>
</html>