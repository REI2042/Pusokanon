document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.status-btn');
    viewButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const resId = this.getAttribute('data-res-id');
            const currentStatus = this.textContent.trim();
            const newStatus = currentStatus === 'Active' ? 'Deactivate' : 'Active';
            Swal.fire({
                title: `Are you sure you want to ${newStatus} this account?`,
                        text: "This action can be undone later.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, proceed!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('phpConn/update_account_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `resId=${resId}&newStatus=${newStatus}`
                    }).then(response => response.json())
                    .then(result => {
                        if (result.success) {
                            Swal.fire(
                                'Success!',
                                `Account has been ${newStatus}d.`,
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Error!',
                                'Failed to update account status.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
});

// function calculateAge(birthDate) {
//     const today = new Date();
//     const birth = new Date(birthDate);
//     let age = today.getFullYear() - birth.getFullYear();
//     const monthDiff = today.getMonth() - birth.getMonth();
//     if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
//         age--;
//     }
//     return age;
// }

// function formatDate(dateString) {
//     const options = { year: 'numeric', month: 'long', day: 'numeric' };
//     const date = new Date(dateString);
//     return date.toLocaleDateString('en-US', options);
// }
