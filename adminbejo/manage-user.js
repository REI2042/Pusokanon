document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('.view-btn');
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const resId = this.getAttribute('data-res-id');
            fetch(`phpConn/get_resident_info.php?id=${resId}`)
                .then(response => response.json())
                .then(data => {
                    const age = calculateAge(data.birth_date);
                    const formattedBirthDate = formatDate(data.birth_date);
                    const profilePic = data.profile_picture ? `../db/ProfilePictures/${data.profile_picture}` : '../PicturesNeeded/blank_profile.png';
                    const confirmButtonColorClass = data.is_active ? 'swal-deactivate-btn' : 'swal-activate-btn';
                    Swal.fire({
                        title: 'Resident Information',
                        html: `
                            <img src="${profilePic}" alt="Profile Picture" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;">
                            <div class="row">
                                <p class="col-12"><strong>ID:</strong> ${data.res_ID}</p>
                                <p class="col-12"><strong>Name:</strong> ${data.res_fname} ${data.res_midname} ${data.res_lname} ${data.res_suffix}</p>
                                <p class="col-12"><strong>Email:</strong> ${data.res_email}</p>
                                <p class="col-12"><strong>Birth Date:</strong> ${formattedBirthDate}</p>
                                <p class="col-4"><strong>Gender:</strong> ${data.gender}</p>
                                <p class="col-4"><strong>Age:</strong> ${age}</p>
                                <p class="col-4"><strong>Sitio:</strong> ${data.addr_sitio}</p>
                                <p class="col-6"><strong>Civil Status:</strong> ${data.civil_status}</p>
                                <p class="col-6"><strong>Citizenship:</strong> ${data.citizenship}</p>
                                <p class="col-6"><strong>Place of Birth:</strong> ${data.place_birth}</p>
                                <p class="col-6"><strong>Contact No:</strong> ${data.contact_no}</p>
                                <p class="col-12"><strong>Registered Voter:</strong> ${data.registered_voter}</p>
                                <p class="col-12"><strong>Account Status:</strong> ${data.is_active ? 'Active' : 'Deactivated'}</p>
                            </div>
                        `,
                        showCancelButton: true,
                        showCloseButton: true,
                        confirmButtonText: data.is_active ? 'Deactivate' : 'Activate',
                        cancelButtonText: 'Edit Information',
                         customClass: {
                            confirmButton: confirmButtonColorClass,
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const newStatus = data.is_active ? 'deactivate' : 'activate';
                            Swal.fire({
                                title: `Are you sure you want to ${newStatus} this account?`,
                                text: "This action can be undone later.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, proceed!'
                            }).then((confirmResult) => {
                                if (confirmResult.isConfirmed) {
                                    fetch('phpConn/update_account_status.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded',
                                        },
                                        body: `id=${resId}&action=${newStatus}`
                                    })
                                    .then(response => response.json())
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
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            console.log(`Gwapo Ko`);
                        }
                    });
                });
        });
    });
});

function calculateAge(birthDate) {
    const today = new Date();
    const birth = new Date(birthDate);
    let age = today.getFullYear() - birth.getFullYear();
    const monthDiff = today.getMonth() - birth.getMonth();
    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birth.getDate())) {
        age--;
    }
    return age;
}

function formatDate(dateString) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', options);
}
