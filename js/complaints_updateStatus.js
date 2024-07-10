// function handleStatusChange(event) {
//     var selectElement = event.target;
//     var form = selectElement.closest('form');
//     var formData = $(form).serialize();

//     $.ajax({
//         url: 'db/DBconn_complaints.php', // The PHP file that will handle the request
//         type: 'POST',
//         data: formData,
//         success: function(response) {
//             response = JSON.parse(response);
//             if (response.success) {
//                 var complaintId = $(form).find('input[name="complaint_id"]').val();
//                 $('#status-' + complaintId).text(selectElement.value);
//             } else {
//                 alert('Failed to update status');
//             }
//         },
//         error: function() {
//             alert('Error updating status');
//         }
//     });
// }

// function handleStatusChange(event) {
//     var selectElement = event.target;
//     var form = selectElement.closest('form');
//     var formData = $(form).serialize();

//     console.log("Sending AJAX request with data:", formData);

//     $.ajax({
//         url: '../db/DBconn_complaints.php', // Ensure this path is correct
//         type: 'POST',
//         data: formData,
//         success: function(response) {
//             console.log("Response received:", response);
//             response = JSON.parse(response);
//             if (response.success) {
//                 var complaintId = $(form).find('input[name="complaint_id"]').val();
//                 $('#status-' + complaintId).text(selectElement.value);
//             } else {
//                 alert('Failed to update status');
//             }
//         },
//         error: function() {
//             console.error('Error updating status');
//             alert('Error updating status');
//         }
//     });
// }

// function handleStatusChange(event, complaint_id) {
//     var selectElement = event.target;
//     var form = selectElement.closest('form');
//     var formData = new FormData(form);

//     fetch('../db/DBconn_complaints.php', {
//         method: 'POST',
//         body: formData
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             document.getElementById('status-' + complaint_id).textContent = data.new_status;
//         } else {
//             alert('Failed to update status: ' + data.error);
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('Error updating status');
//     });
// }

// function updateStatus(complaintId, newStatus) {
//     fetch('../db/DBconn_complaints.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         body: `complaint_id=${complaintId}&status=${newStatus}`
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             document.getElementById(`status-${data.complaint_id}`).textContent = data.new_status;
//             console.log(`Status updated for complaint ${data.complaint_id} to ${data.new_status}`);
//         } else {
//             console.error('Failed to update status:', data.error);
//             alert('Failed to update status. Please try again.');
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('Error updating status. Please try again.');
//     });
// }

// function updateStatus(complaint_id, newStatus) {
//     fetch('../db/DBconn_complaints.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         body: `complaint_id=${complaint_id}&status=${newStatus}`
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             // Reload the page if update was successful
//             window.location.reload();
//         } else {
//             console.error('Failed to update status:', data.error);
//             alert('Failed to update status. Please try again.');
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('Error updating status. Please try again.');
//     });
// }