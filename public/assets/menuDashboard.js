document.addEventListener("DOMContentLoaded", function () {

  const dropdowns = document.querySelectorAll(".dashboard_menu_lists > li > .dropdown");
  const sidebar = document.getElementById("dashboard_sidebar_i");

  dropdowns.forEach(dropdown => {

    dropdown.addEventListener("click", function(e){

      e.preventDefault();

      const parentLi = this.parentElement;
      const submenu = parentLi.querySelector(".submenu");

      dropdowns.forEach(el => {

        if(el !== this){
          el.classList.remove("active");

          const otherSub = el.parentElement.querySelector(".submenu");
          if(otherSub){
            otherSub.style.display = "none";
          }
        }

      });

      this.classList.toggle("active");

      if(submenu){
        submenu.style.display =
          submenu.style.display === "block" ? "none" : "block";
      }

    });

  });

});