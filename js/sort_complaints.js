document.querySelectorAll('.dropdown-item[data-incident-place]').forEach(function(item) {
    item.addEventListener('click', function() {
        const incidentPlace = this.getAttribute('data-incident-place');
        const caseType = new URLSearchParams(window.location.search).get('case_type') || '';
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('incident_place', incidentPlace);
        currentUrl.searchParams.set('case_type', caseType);
        window.location.href = currentUrl.toString();
    });
});

document.querySelectorAll('.dropdown-item[data-case-type]').forEach(function(item) {
    item.addEventListener('click', function() {
        const caseType = this.getAttribute('data-case-type');
        const incidentPlace = new URLSearchParams(window.location.search).get('incident_place') || '';
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('case_type', caseType);
        currentUrl.searchParams.set('incident_place', incidentPlace);
        window.location.href = currentUrl.toString();
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchInput = document.getElementById('searchInput');

    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchTerm = searchInput.value.trim();
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('search', searchTerm);
            window.location.href = currentUrl.toString();
        });
    }
});