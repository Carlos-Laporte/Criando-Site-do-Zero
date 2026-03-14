document.addEventListener("DOMContentLoaded", function () {

    const dropdown = document.getElementById("dropdown");
    const submenu = document.getElementById("submenu");

    dropdown.addEventListener("click", function(e) {

        e.preventDefault();

        if (submenu.style.display === "block") {
            submenu.style.display = "none";
        } else {
            submenu.style.display = "block";
        }

    });

});