const hamBurger = document.querySelector(".toggle-btn");
const sidebar = document.querySelector("#sidebar");
const sidebarLinks = document.querySelectorAll("#sidebar .sidebar-link .span-word");

hamBurger.addEventListener("click", function () {
    sidebar.classList.toggle("expand");
    
    if (sidebar.classList.contains("expand")) {
        setTimeout(() => {
            sidebar.classList.add("show-text");
        }, 100); 
    } else {
        sidebar.classList.remove("show-text");
    }
}); 