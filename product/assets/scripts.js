
const taggleBtn = document.querySelector(".list");

const dashboard_sidebar = document.getElementById("dashboard_sidebar_i");
const dashboard_sidebar_user_span = document.querySelector(".dashboard_sidebar_user span");
const dashboard_content_conteiner = document.getElementById("dashboard_content_conteiner");
const dashboard_logo = document.querySelector(".dashboard_logo");
const userImage = document.getElementById("userImage");

var sideBarIsOpen = true;

taggleBtn.addEventListener('click', (event) => { event.preventDefault();

    if(sideBarIsOpen){
        dashboard_sidebar.style.width = '0%';
        dashboard_sidebar.style.transition = '0.5s all';
        dashboard_sidebar_user_span.style.fontSize = '0px';
        dashboard_content_conteiner.style.width = '85%';
        userImage.style.width = '0px'; 
        userImage.style.border= '0px';
        dashboard_logo.style.fontSize = '0px';
        
        menuIcons = document.getElementsByClassName('menuText');
        for(var i=0; i< menuIcons.length; i++){
            menuIcons[i].style.display = 'none';
        }
        
        document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'center';
        sideBarIsOpen = false;
    }else{
        dashboard_sidebar.style.width = '20%';
        dashboard_content_conteiner.style.width = '80%';
        dashboard_logo.style.fontSize = '80px';
        userImage.style.width = '80px'; 
        dashboard_sidebar_user_span.style.fontSize = '30px';
        
        menuIcons = document.getElementsByClassName('menuText');
        for(var i=0; i< menuIcons.length; i++){
            menuIcons[i].style.display = 'inline-block';
        }
        
        document.getElementsByClassName('dashboard_menu_lists')[0].style.textAlign = 'left';
        sideBarIsOpen = true;
    }
    
});