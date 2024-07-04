document.getElementById('complaintForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    var formData = new FormData(this);

    fetch('db/DBconn_complaints.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Complaint Submitted',
                text: data.message,
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'residentComplaints.php'; 
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while submitting the complaint.',
            confirmButtonText: 'OK'
        });
        console.error('Error:', error);
    });
});

