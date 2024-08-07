// $(document).ready(function() {
    // Store the original table content
    // var originalContent = $('#originalTable').html();

    // $('#search_name').keyup(function() {
    //     var input = $(this).val();
    //     if (input.length > 0) {
    //         $.ajax({
    //             url: 'phpConn/get_names.php',
    //             method: 'POST',
    //             data: { input: input },
    //             success: function(data) {
    //                 $('#searchresult').html(data);
    //             }
    //         });
    //     } else {
    //         // If the search input is empty, show the original table
    //         $('#searchresult').html(originalContent);
    //         // Reattach event listeners for table switching
    //         attachTableSwitchListeners();
    //     }
    // });
    // function attachTableSwitchListeners() {
    //     $('#showTable1').click(function() {
    //         showTable('table1Container', 'pendingPagination');
    //         $(this).addClass('active');
    //         $('#showTable2, #showTable3').removeClass('active');
    //     });

    //     $('#showTable2').click(function() {
    //         showTable('table2Container', 'processingPagination');
    //         $(this).addClass('active');
    //         $('#showTable1, #showTable3').removeClass('active');
    //     });

    //     $('#showTable3').click(function() {
    //         showTable('table3Container', 'completedPagination');
    //         $(this).addClass('active');
    //         $('#showTable1, #showTable2').removeClass('active');
    //     });
    // }

    // // Initial attachment of listeners
    // attachTableSwitchListeners();
    // });
function showTable(tableId, paginationId) {
    document.getElementById('table1Container').classList.add('hidden');
    document.getElementById('table2Container').classList.add('hidden');
    document.getElementById('table3Container').classList.add('hidden');
    document.getElementById('pendingPagination').classList.add('hidden');
    document.getElementById('processingPagination').classList.add('hidden');
    document.getElementById('completedPagination').classList.add('hidden');
    document.getElementById(tableId).classList.remove('hidden');
    document.getElementById(paginationId).classList.remove('hidden');
}

document.getElementById('showTable1').addEventListener('click', function() {
    showTable('table1Container', 'pendingPagination');
    document.getElementById('showTable1').classList.add('active');
    document.getElementById('showTable2').classList.remove('active');
    document.getElementById('showTable3').classList.remove('active');
});

document.getElementById('showTable2').addEventListener('click', function() {
    showTable('table2Container', 'processingPagination');
    document.getElementById('showTable2').classList.add('active');
    document.getElementById('showTable1').classList.remove('active');
    document.getElementById('showTable3').classList.remove('active');
});

document.getElementById('showTable3').addEventListener('click', function() {
    showTable('table3Container', 'completedPagination');
    document.getElementById('showTable3').classList.add('active');
    document.getElementById('showTable1').classList.remove('active');
    document.getElementById('showTable2').classList.remove('active');
});

// Set initial visibility based on session storage
let activeTable = 'table1Container';
let activePagination = 'pendingPagination';
let activeLink = 'showTable1';
// let activeTable = sessionStorage.getItem('activeTable') || 'table1Container';
// let activePagination = sessionStorage.getItem('activePagination') || 'pendingPagination';
// let activeLink = sessionStorage.getItem('activeLink') || 'showTable1';

showTable(activeTable, activePagination);
document.getElementById(activeLink).classList.add('active');


// Store the active table in session storage on click
document.getElementById('showTable1').addEventListener('click', function() {
    sessionStorage.setItem('activeTable', 'table1Container');
    sessionStorage.setItem('activePagination', 'pendingPagination');
    sessionStorage.setItem('activeLink', 'showTable1');
});

document.getElementById('showTable2').addEventListener('click', function() {
    sessionStorage.setItem('activeTable', 'table2Container');
    sessionStorage.setItem('activePagination', 'processingPagination');
    sessionStorage.setItem('activeLink', 'showTable2');
});

document.getElementById('showTable3').addEventListener('click', function() {
    sessionStorage.setItem('activeTable', 'table3Container');
    sessionStorage.setItem('activePagination', 'completedPagination');
    sessionStorage.setItem('activeLink', 'showTable3');
});