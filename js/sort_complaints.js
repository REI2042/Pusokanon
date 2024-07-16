document.addEventListener('DOMContentLoaded', function() {
    const dropdownItems = document.querySelectorAll('#caseTypeDropdown + .dropdown-menu .dropdown-item');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const caseType = this.getAttribute('data-case-type');
            window.location.href = `?page=1&case_type=${encodeURIComponent(caseType)}`;
        });
    });
});
