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

// Add this function to handle pagination clicks
function handlePaginationClick(event, status) {
    event.preventDefault();
    const url = new URL(event.target.href);
    const page = url.searchParams.get(`${status}Page`);
    const caseType = url.searchParams.get('case_type');
    const searchTerm = url.searchParams.get('searchTerm');
    const incidentPlace = url.searchParams.get('incident_place');

    // Here you would typically make an AJAX call to fetch the new page data
    // For now, we'll just reload the page with the new parameters
    window.location.href = `?${status}Page=${page}&case_type=${caseType}&searchTerm=${searchTerm}&incident_place=${incidentPlace}`;
}

// Add event listeners for pagination links
document.addEventListener('DOMContentLoaded', function() {
    const statuses = ['pending', 'approved', 'rejected'];
    statuses.forEach(status => {
        const pagination = document.getElementById(`${status}Pagination`);
        if (pagination) {
            pagination.addEventListener('click', function(event) {
                if (event.target.tagName === 'A') {
                    handlePaginationClick(event, status);
                }
            });
        }
    });
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
