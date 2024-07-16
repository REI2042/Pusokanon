document.querySelectorAll('.dropdown-item[data-incident-place]').forEach(function(item) {
    item.addEventListener('click', function() {
        const incidentPlace = this.getAttribute('data-incident-place');
        const caseType = new URLSearchParams(window.location.search).get('case_type') || '';
        window.location.href = `?incident_place=${encodeURIComponent(incidentPlace)}&case_type=${encodeURIComponent(caseType)}`;
    });
});

document.querySelectorAll('.dropdown-item[data-case-type]').forEach(function(item) {
    item.addEventListener('click', function() {
        const caseType = this.getAttribute('data-case-type');
        const incidentPlace = new URLSearchParams(window.location.search).get('incident_place') || '';
        window.location.href = `?case_type=${encodeURIComponent(caseType)}&incident_place=${encodeURIComponent(incidentPlace)}`;
    });
});