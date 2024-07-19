// Function to switch between tables
function showTable(status) {
    const tables = ['pendingTable', 'approvedTable', 'rejectedTable'];
    const buttons = ['pendingBtn', 'approvedBtn', 'rejectedBtn'];
    const paginations = ['pendingPagination', 'approvedPagination', 'rejectedPagination'];

    tables.forEach((table) => {
        document.getElementById(table).classList.add('hidden');
    });

    buttons.forEach((button) => {
        document.getElementById(button).classList.remove('active');
    });

    paginations.forEach((pagination) => {
        const paginationElement = document.getElementById(pagination);
        if (paginationElement) {
            paginationElement.classList.add('hidden');
        }
    });

    document.getElementById(`${status}Table`).classList.remove('hidden');
    document.getElementById(`${status}Btn`).classList.add('active');

    const currentPagination = document.getElementById(`${status}Pagination`);
    if (currentPagination) {
        currentPagination.classList.remove('hidden');
    }
}


// Call this function on page load to set the initial pagination
document.addEventListener('DOMContentLoaded', function() {
    const activeButton = document.querySelector('.status-button.active');
    if (activeButton) {
        const status = activeButton.id.replace('Btn', '').toLowerCase();
        updatePagination(status);
    }
});

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
