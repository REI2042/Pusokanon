document.addEventListener('DOMContentLoaded', function() {
    var caseTypeSelect = document.getElementById('case_type');
    var customCaseType = ''; // This will hold the custom case type

    if (caseTypeSelect) {
        caseTypeSelect.addEventListener('change', function() {
            if (this.value === 'Other') {
                Swal.fire({
                    title: 'Other Case Type',
                    input: 'text',
                    inputLabel: 'Please specify the case type',
                    inputPlaceholder: 'Enter case type here',
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'You need to write something!'
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        customCaseType = result.value;
                        console.log('Custom case type:', customCaseType);
                        
                        // Update the select element to show the custom value
                        let customOption = document.querySelector('#case_type option[value="Other"]');
                        customOption.textContent = customCaseType;
                    } else {
                        this.selectedIndex = 0;
                        customCaseType = '';
                    }
                });
            } else {
                customCaseType = '';
            }
        });
    }

    var complaintForm = document.getElementById('complaintForm');
    if (complaintForm) {
        complaintForm.addEventListener('submit', function(event) {
            event.preventDefault();
            var formData = new FormData(this);

            // If a custom case type was entered, use it instead of 'Other'
            if (customCaseType) {
                formData.set('case_type', customCaseType);
            }

            console.log("FormData content:");
            for (var [key, value] of formData.entries()) {
                console.log(key, value);
            }

            fetch('db/DBconn_adminComplaints.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log("Response Status:", response.status);
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error('Network response was not ok: ' + text);
                    });
                }
                return response.json();
            })
            .then(data => {
                console.log("Response Data:", data);
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Complaint Submitted',
                        text: data.message,
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'writeComplaints.php';
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
                    text: 'An error occurred: ' + error.message,
                    confirmButtonText: 'OK'
                });
                console.error('Error:', error);
            });
        });
    }
});