// Function to switch between tables
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
    if (tables[status]) {
        tables[status].style.display = 'block';
        pagination[status].style.display = 'block';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    var status = 'pending'; // Default status
    var queryString = new URLSearchParams(window.location.search);
    if (queryString.has('status')) {
        status = queryString.get('status');
    }
    showTable(status);
});



// Call this function on page load to set the initial pagination
// document.addEventListener('DOMContentLoaded', function() {
//     const activeButton = document.querySelector('.status-button.active');
//     if (activeButton) {
//         const status = activeButton.id.replace('Btn', '').toLowerCase();
//         updatePagination(status);
//     }
// });

// Event listeners for incident place dropdown
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

// Event listeners for case type dropdown
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

// Event listener for search form submission
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
