document.addEventListener("DOMContentLoaded", function() {
    const burgerMenu = document.getElementById("burgerMenu");
    const sidebar = document.querySelector(".admin-sidebar");
  
    if (burgerMenu && sidebar) {
        burgerMenu.addEventListener("click", function() {
            sidebar.classList.toggle("active");
        });
    }
  });
  