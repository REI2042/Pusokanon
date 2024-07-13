document.addEventListener('DOMContentLoaded', () => {
    const eyeIcons = document.querySelectorAll('#eyeicon');
    const currentPassword = document.getElementById('currentpassword');
    const newPassword = document.getElementById('newpassword');
    const repeatPassword = document.getElementById('repeatpassword');
    const passwordError = document.getElementById('password-error');
    const currentPasswordError = document.getElementById('current-password-error');
    const form = document.querySelector('.change-pass');

    eyeIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            const passwordField = icon.previousElementSibling;
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });

    function validatePasswords() {
        if (repeatPassword.value !== '' && newPassword.value !== repeatPassword.value) {
            repeatPassword.classList.add('input-error');
            passwordError.style.display = 'block';
        } else {
            repeatPassword.classList.remove('input-error');
            passwordError.style.display = 'none';
        }
    }

    newPassword.addEventListener('input', validatePasswords);
    repeatPassword.addEventListener('input', validatePasswords);

    currentPassword.addEventListener('input', () => {
        currentPassword.classList.remove('input-error');
        currentPasswordError.style.display = 'none';
    });

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to change your password?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it!',
            confirmButtonColor: '#3D7CC4',
            cancelButtonColor: '#d33',
            customClass: {
                popup: 'custom-swal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                if (newPassword.value !== repeatPassword.value) {
                    repeatPassword.classList.add('input-error');
                    passwordError.style.display = 'block';
                } else {
                    fetch('db/change_password.php', {
                        method: 'POST',
                        body: new FormData(form)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: 'Changed',
                                text: "Your password has been changed.",
                                icon: 'success',
                                confirmButtonColor: '#3D7CC4',
                                customClass: {
                                    popup: 'custom-swal'
                                }
                            }).then(() => {
                                window.location.href = 'Profile.php';
                            });
                        } else {
                            if (data.error === 'current_password') {
                                currentPassword.classList.add('input-error');
                                currentPasswordError.textContent = data.message;
                                currentPasswordError.style.display = 'block';
                            }
                        }
                    });
                }
            }
        });
    });
});