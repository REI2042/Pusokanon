document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            placement: 'left'
        })
    })
    const viewButtons = document.querySelectorAll('.view-btn');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const resId = this.getAttribute('data-res-id');
            const currentUrl = new URL(window.location.href);
            const params = new URLSearchParams(currentUrl.search);
            params.append('id', resId);
            window.location.href = `residentProfile.php?${params.toString()}`;
        });
    });

    const statusButtons = document.querySelectorAll('.status-btn');
    statusButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const resId = this.getAttribute('data-res-id');
            const currentStatus = this.textContent.trim();
            const newStatus = currentStatus === 'Deactivate' ? 'Deactivate' : 'Activate';
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

    document.getElementById('searchInput').addEventListener('input', function() {
        if (this.value === '') {
            document.getElementById('searchForm').submit();
        }
    });
});