document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('searchInput').addEventListener('input', function () {
        if (this.value === '') {
            document.getElementById('searchForm').submit();
        }
    });

    window.deactivateStaff = function(staff_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to deactivate this account?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, deactivate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "phpConn/deactivate_staff.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        Swal.fire(
                            'Deactivated!',
                            'The account has been deactivated.',
                            'success'
                        ).then(() => {
                            location.reload(); // Refresh the page to reflect the changes
                        });
                    }
                };
                xhr.send("staff_id=" + staff_id);
            }
        });
    };

    window.activateStaff = function(staff_id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to activate this account?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, activate it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "phpConn/activate_staff.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        Swal.fire(
                            'Activated!',
                            'The account has been activated.',
                            'success'
                        ).then(() => {
                            location.reload(); // Refresh the page to reflect the changes
                        });
                    }
                };
                xhr.send("staff_id=" + staff_id);
            }
        });
    };
});


document.getElementById('searchInput').addEventListener('input', function() {
    if (this.value === '') {
        document.getElementById('searchForm').submit();
    }
});

