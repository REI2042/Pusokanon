document.addEventListener('DOMContentLoaded', () => {
    const hamBurger = document.querySelector(".toggle-btn");
    const sidebar = document.querySelector("#sidebar");
    const dropdowns = sidebar.querySelectorAll('.sidebar-link.collapsed');

    let isMobile = window.innerWidth < 768;

    function initializeSidebarBehavior() {
        if (isMobile) {
            sidebar.removeEventListener("mouseenter", expandSidebar);
            sidebar.removeEventListener("mouseleave", collapseSidebar);
            hamBurger.addEventListener("click", toggleSidebar);
        } else {
            hamBurger.removeEventListener("click", toggleSidebar);
            sidebar.addEventListener("mouseenter", expandSidebar);
            sidebar.addEventListener("mouseleave", collapseSidebar);
        }
    }

    function toggleSidebar() {
        if (sidebar.classList.contains("expand")) {
            collapseSidebar();
        } else {
            expandSidebar();
        }
    }

    function expandSidebar() {
        sidebar.classList.add("expand");
        setTimeout(() => {
            sidebar.classList.add("show-text");
        }, 100);
        localStorage.setItem('sidebarExpanded', 'true');

        clearDropdownStates();

        dropdowns.forEach(dropdown => {
            const targetId = dropdown.getAttribute('data-bs-target');
            const target = document.querySelector(targetId);
            if (target && target.classList.contains('show')) {
                localStorage.setItem(targetId, 'expanded');
                dropdown.classList.remove('collapsed');
                dropdown.setAttribute('aria-expanded', 'true');
            }
        });
    }

    function clearDropdownStates() {
        dropdowns.forEach(dropdown => {
            const targetId = dropdown.getAttribute('data-bs-target');
            localStorage.removeItem(targetId);
        }); 
    }

    function collapseSidebar() {
        sidebar.classList.remove("expand");
        sidebar.classList.remove("show-text");
        localStorage.setItem('sidebarExpanded', 'false');

        dropdowns.forEach(dropdown => {
            const targetId = dropdown.getAttribute('data-bs-target');
            const target = document.querySelector(targetId);
            if (target) {
                localStorage.removeItem(targetId);
                if (target.classList.contains('show')) {
                    target.classList.remove('show');
                    dropdown.classList.add('collapsed');
                    dropdown.setAttribute('aria-expanded', 'false');
                }
            }
        });
    }

    if (localStorage.getItem('sidebarExpanded') === 'true') {
        sidebar.style.transition = 'none';
        sidebar.classList.add("expand");
        sidebar.classList.add("show-text");
        
        dropdowns.forEach(dropdown => {
            const targetId = dropdown.getAttribute('data-bs-target');
            if (localStorage.getItem(targetId) === 'expanded') {
                const target = document.querySelector(targetId);
                if (target) {
                    target.classList.add('show');
                    dropdown.classList.remove('collapsed');
                    dropdown.setAttribute('aria-expanded', 'true');
                }
            }
        });

        setTimeout(() => {
            sidebar.style.transition = 'all .25s ease-in-out';
        }, 100);
    }

    document.addEventListener("click", function(event) {
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnHamburger = hamBurger.contains(event.target);
        
        if (!isClickInsideSidebar && !isClickOnHamburger && sidebar.classList.contains("expand")) {
            collapseSidebar();
        }
    });

    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', () => {
            const targetId = dropdown.getAttribute('data-bs-target');
            clearDropdownStates();
            if (!dropdown.classList.contains('collapsed')) {
                localStorage.setItem(targetId, 'expanded');
            }
        });
    });

    initializeSidebarBehavior();

    window.addEventListener('resize', () => {
        const currentIsMobile = window.innerWidth < 768;
        if (currentIsMobile !== isMobile) {
            isMobile = currentIsMobile;
            initializeSidebarBehavior();
        }
    });
});