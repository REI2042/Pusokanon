function handleStatusChange(event) {
    var selectElement = event.target;
    var form = selectElement.closest('form');
    var formData = $(form).serialize();

    $.ajax({
        url: 'DBconn_complaints.php', // The PHP file that will handle the request
        type: 'POST',
        data: formData,
        success: function(response) {
            response = JSON.parse(response);
            if (response.success) {
                var complaintId = $(form).find('input[name="complaint_id"]').val();
                $('#status-' + complaintId).text(selectElement.value);
            } else {
                alert('Failed to update status');
            }
        },
        error: function() {
            alert('Error updating status');
        }
    });
}
