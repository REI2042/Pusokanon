
// Event listeners for incident place dropdown
document.querySelectorAll('.dropdown-item[data-incident-place]').forEach(function(item) {
    item.addEventListener('click', function() {
        const incidentPlace = this.getAttribute('data-incident-place');
        const caseType = new URLSearchParams(window.location.search).get('case_type') || '';
        const status = new URLSearchParams(window.location.search).get('status') || '';
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('incident_place', incidentPlace);
        currentUrl.searchParams.set('case_type', caseType);
        currentUrl.searchParams.set('status', status); 
        window.location.href = currentUrl.toString();
    });
});

// Event listeners for case type dropdown
document.querySelectorAll('.dropdown-item[data-case-type]').forEach(function(item) {
    item.addEventListener('click', function() {
        const caseType = this.getAttribute('data-case-type');
        const incidentPlace = new URLSearchParams(window.location.search).get('incident_place') || '';
        const status = new URLSearchParams(window.location.search).get('status') || ''; 
        const currentUrl = new URL(window.location.href);

        if (caseType === "Other") {
            currentUrl.searchParams.set('case_type', 'Other');
        } else {
            currentUrl.searchParams.set('case_type', caseType);
        }

        currentUrl.searchParams.set('incident_place', incidentPlace);
        currentUrl.searchParams.set('status', status); 
        
        // Store the current visible table
        const visibleTable = document.querySelector('#results > div[style*="display: block"]');
        const visibleTableId = visibleTable ? visibleTable.id : null;
        
        // Navigate to the new URL
        window.location.href = currentUrl.toString();
        
        // After navigation, show the previously visible table
        if (visibleTableId) {
            window.addEventListener('load', function() {
                showTable(visibleTableId.replace('Container', ''));
            });
        }
    });
});

// Event listeners for status dropdown
document.querySelectorAll('.dropdown-item[data-status]').forEach(function(item) {
    item.addEventListener('click', function() {
        const status = this.getAttribute('data-status');
        const incidentPlace = new URLSearchParams(window.location.search).get('incident_place') || '';
        const caseType = new URLSearchParams(window.location.search).get('case_type') || ''; 
        const currentUrl = new URL(window.location.href);
        currentUrl.searchParams.set('case_type', caseType);
        currentUrl.searchParams.set('incident_place', incidentPlace);
        currentUrl.searchParams.set('status', status); 
        window.location.href = currentUrl.toString();
    });
});

document.getElementById('searchInput').addEventListener('input', function() {
    if (this.value === '') {
        document.getElementById('searchForm').submit();
    }
});

function showTable(status) {
    var tables = {
        pending: document.getElementById('pendingContainer'),
        approved: document.getElementById('approvedContainer'),
        rejected: document.getElementById('rejectedContainer')
    };
    var pagination = {
        pending: document.getElementById('pendingPagination'),
        approved: document.getElementById('approvedPagination'),
        rejected: document.getElementById('rejectedPagination')
    };

    // Hide all tables and pagination
    for (var key in tables) {
        if (tables.hasOwnProperty(key)) {
            tables[key].style.display = 'none';
            pagination[key].style.display = 'none';
        }
    }

    // Show the selected table and pagination
    if (tables[status] || tables[status + 'Container']) {
        const tableToShow = tables[status] || tables[status + 'Container'];
        const paginationToShow = pagination[status] || pagination[status + 'Container'];
        tableToShow.style.display = 'block';
        paginationToShow.style.display = 'block';
    }
}

function getCurrentStatus() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('status') || 'pending'; // Default to 'pending' if no status is set
}

document.addEventListener('DOMContentLoaded', function () {
    const status = getCurrentStatus();
    showTable(status);

    // Highlight the correct status link
    document.querySelectorAll('.status-link').forEach(link => {
        link.classList.remove('active');
    });
    document.getElementById(status + 'Link').classList.add('active');
});

window.addEventListener('popstate', function() {
    const status = getCurrentStatus();
    showTable(status);
});


