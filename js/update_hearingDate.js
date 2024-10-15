function editHearing(complaintId, currentDate, currentTime) {
    Swal.fire({
        title: 'Edit Hearing',
        html:
            '<input id="swal-input1" class="swal2-input" placeholder="New hearing date (YYYY-MM-DD)" value="' + currentDate + '">' +
            '<input id="swal-input2" class="swal2-input" placeholder="New hearing time (HH:MM)" value="' + currentTime + '">',
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('swal-input1').value,
                document.getElementById('swal-input2').value
            ]
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const [newDate, newTime] = result.value;
            if (newDate && newTime) {
                // JSON data to update the hearing date and time
                var data = {
                    complaint_id: complaintId,
                    hearing_date: newDate,
                    hearing_time: newTime
                };

                // Fetch API to send JSON data
                fetch('../adminbejo/phpConn/update_hearing.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(result => {
                    if (result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Hearing date and time updated successfully',
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: result.message || 'Failed to update hearing date and time',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating hearing date and time: ' + error.message,
                    });
                    console.error('Error:', error);
                });
            }
        }
    });
}