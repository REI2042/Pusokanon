document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-btn');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const resId = this.getAttribute('data-res-id');
            fetch(`phpConn/get_resident_info.php?id=${resId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire('Error', data.error, 'error');
                    } else {
                        const suffix = data.res_suffix.trim() ? data.res_suffix : 'N/A';

                        Swal.fire({
                            title: 'Resident Profile Information',
                            html: `
                                 <div class="row mx-0">
                                    <div class="col-12 text-center">
                                        <img src="${data.profile_picture ? '../db/ProfilePictures/' + data.profile_picture : '../PicturesNeeded/blank_profile.png'}" class="profile-picture m-1" alt="Profile Picture"/>
                                        <p class="resident-id my-1"><strong>ID Number:</strong> ${data.res_ID}</p>
                                        <p class="account-status my-1"><strong>Account Status:</strong>  ${data.is_active ? 'Active' : 'Deactivated'}</p>
                                    </div>
                                </div>
                                <div class="row infos mx-0 mx-sm-3 my-3 text-start">
                                    <p class="first-name col-12 col-sm-6 mb-2"><strong>First Name:</strong> ${data.res_fname}</p>
                                    <p class="last-name col-12 col-sm-6 mb-2"><strong>Last Name:</strong> ${data.res_lname}</p>
                                    <p class="middle-name col-12 col-sm-6 mb-2"><strong>Middle Name:</strong> ${data.res_midname}</p>
                                    <p class="suffix col-12 col-sm-6 mb-2"><strong>Suffix:</strong> ${suffix}</p>
                                    <p class="gender col-12 col-sm-6 mb-2"><strong>Gender:</strong> ${data.gender}</p>
                                    <p class="birth-date col-12 col-sm-6 mb-2"><strong>Birthdate:</strong> ${data.formatted_birth_date}</p>
                                    <p class="age col-12 col-sm-6 mb-2"><strong>Age:</strong> ${data.age}</p>
                                    <p class="voter col-12 col-sm-6 mb-2"><strong>Registered Voter:</strong> ${data.formatted_voter_status}</p>
                                    <p class="voter col-12 col-sm-6 mb-2"><strong>Civil Status:</strong> ${data.civil_status}</p>
                                    <p class="voter col-12 col-sm-6 mb-2"><strong>Citizenship:</strong> ${data.citizenship}</p>
                                    <p class="voter col-12 mb-2"><strong>Place of Birth:</strong> ${data.place_birth}</p>
                                    <p class="voter col-12 mb-2"><strong>Contact Number:</strong> ${data.contact_no}</p>                                
                                    <p class="voter col-12 mb-2"><strong>Email Address:</strong> ${data.res_email}</p>
                                    <p class="voter col-12 mb-2"><strong>Address:</strong> ${data.addr_sitio} Barangay Pusok, Lapu - Lapu City</p>
                                </div>
                            `,
                            confirmButtonText: 'Close',
                            showCloseButton: true,
                            confirmButtonText: 'Edit Profile',
                            confirmButtonColor: '#3085d6',
                            customClass: {
                                popup: 'custom-swal'
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const returnUrl = button.getAttribute('data-return-url');
                                window.location.href = `EditResidentProfile.php?id=${resId}&return_url=${returnUrl}`;
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error', 'Failed to fetch resident information', 'error');
                });
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