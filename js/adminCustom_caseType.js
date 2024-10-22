// admin complaint form popup
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('admincomplaintForm').addEventListener('submit', function(event) {
        event.preventDefault(); 
        var formData = new FormData(this);
    
        fetch('../db/DBconn_adminComplaints.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: 'Complaint Submitted',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = 'writeComplaints.php'; 
                });
            } else {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                      toast.onmouseenter = Swal.stopTimer;
                      toast.onmouseleave = Swal.resumeTimer;
                    }
                  });
                  Toast.fire({
                    icon: "error",
                    text: data.message,
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

});
// other case typ pop up
document.addEventListener('DOMContentLoaded', function() {
    const caseTypeSelect = document.getElementById('case_type');

    caseTypeSelect.addEventListener('change', function() {
        if (this.value === 'Other') {
            Swal.fire({
                title: 'Enter Custom Case Type',
                input: 'text',
                inputPlaceholder: 'Enter the case type',
                showCancelButton: true,
                inputValidator: (value) => {
                    if (!value) {
                        return 'You need to enter something!';
                    }
                }
            }).then((result) => {
                            if (result.isConfirmed) {
                    const customType = result.value;
                    
                    // Create a new option
                    const newOption = new Option(customType, customType, true, true);
                    
                    // Remove the temporary "Other" option if it exists
                    const tempOther = caseTypeSelect.querySelector('option[value="Other_temp"]');
                    if (tempOther) {
                        caseTypeSelect.removeChild(tempOther);
                    }
                    
                    // Add the new option to the select
                    caseTypeSelect.add(newOption);
                    
                    // Select the new option
                    caseTypeSelect.value = customType;
                } else {
                    // If user cancels, revert to the first option
                    caseTypeSelect.value = caseTypeSelect.options[0].value;
                }
            });

            // Add a temporary "Other" option
            const tempOption = new Option("Other", "Other_temp", true, true);
            caseTypeSelect.add(tempOption);
        }
    });
}); 