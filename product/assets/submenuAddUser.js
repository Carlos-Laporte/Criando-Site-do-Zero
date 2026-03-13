const btn = document.getElementById("addUserBtn");
const submenu = document.getElementById("submenuAddUser");

btn.addEventListener("click", function(e){
    e.preventDefault();
    submenu.classList.toggle("active");
});