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

function closeSidebar() {
    sidebar.classList.remove("expand");
    sidebar.classList.remove("show-text");
}

document.addEventListener("click", function(event) {
    const isClickInsideSidebar = sidebar.contains(event.target);
    const isClickOnHamburger = hamBurger.contains(event.target);
    
    if (!isClickInsideSidebar && !isClickOnHamburger && sidebar.classList.contains("expand")) {
        closeSidebar();
    }
});