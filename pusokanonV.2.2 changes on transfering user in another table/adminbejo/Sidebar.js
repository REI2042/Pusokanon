const hamBurger = document.querySelector(".toggle-btn");
const sidebar = document.querySelector("#sidebar");
const sidebarLinks = document.querySelectorAll("#sidebar .sidebar-link span");

hamBurger.addEventListener("click", function () {
    sidebar.classList.toggle("expand");
    sidebarLinks.forEach(span => {
        span.classList.toggle("expand");
    });
});