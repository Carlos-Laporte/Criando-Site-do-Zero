
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