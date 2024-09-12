document.addEventListener('DOMContentLoaded', function() {
    const updateProfileBtn = document.getElementById('updateProfileBtn');
    const fileInput = document.getElementById('file');
    const profilePreview = document.getElementById('profile-preview');
    const uploadButton = document.getElementById('upload_button');
    const cameraIcon = document.getElementById('camera-icon');
    const removeIcon = document.getElementById('remove-icon');
    let originalSrc = profilePreview.src;
    const contactInput = document.getElementById('Contact');
    const form = document.querySelector('form');
    const emailInput = document.getElementById('email');


    const originalValues = {
        fname: form.fname.value,
        lname: form.lname.value,
        midname: form.midname.value,
        sufname: form.sufname.value,
        gender: form.gender.value,
        bday: form.bday.value,
        bmonth: form.bmonth.value,
        byear: form.byear.value,
        civilStatus: form.civilStatus.value,
        citizenship: form.citizenship.value,
        placeBirth: form.placeBirth.value,
        voter: form.voter.value,
        addsitio: form.addsitio.value,
        contactNo: form.contactNo.value,
        accemail: form.accemail.value
    };

    updateProfileBtn.addEventListener('click', function(event) {
        event.preventDefault();
        const contactValue = contactInput.value;
        const contactPattern = /^09[0-9]{2}\s[0-9]{3}\s[0-9]{4}$/;
        const emailValue = emailInput.value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!contactPattern.test(contactValue)) {
            
            Swal.fire({
                title: 'Invalid Contact Number',
                text: "Please enter a valid contact number in the format 09XX XXX XXXX.",
                icon: 'error',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#3D7CC4',
                customClass: {
                    popup: 'custom-swal'
                }
            });

            return;
        }

        if (!hasChanges()) {
            Swal.fire({
                title: 'No Changes Detected',
                text: "You haven't made any changes.",
                icon: 'info',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#3D7CC4',
                customClass: {
                    popup: 'custom-swal'
                }
            });
            return;
        }

        if (!emailPattern.test(emailValue)) {
            Swal.fire({
                title: 'Invalid Email Address',
                text: "Please enter a valid email address.",
                icon: 'error',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#3D7CC4',
                customClass: {
                    popup: 'custom-swal'
                }
            });
            return;
        }
        
        Swal.fire({
            title: 'Confirm Update',
            text: "Are you sure you want to update your profile?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
            confirmButtonColor: '#3D7CC4',
            cancelButtonColor: '#d33',
            customClass: {
                popup: 'custom-swal'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Updated!',
                    text: 'Profile has been updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'Ok',
                    confirmButtonColor: '#3D7CC4',
                    customClass: {
                        popup: 'custom-swal'
                    }
                }).then(() => {
                    document.querySelector('form').submit();
                });
            }
        });
    });

    fileInput.addEventListener('change', function() {
        handleFileSelect(this);
    });

    uploadButton.addEventListener('click', function(event) {
        if (uploadButton.classList.contains('remove-mode')) {
            event.preventDefault();
            profilePreview.src = originalSrc;
            fileInput.value = '';
            uploadButton.classList.remove('remove-mode');
            cameraIcon.style.display = 'inline';
            removeIcon.style.display = 'none';
            uploadButton.setAttribute('title','Select Picture');
        }
    });

    function handleFileSelect(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                profilePreview.src = e.target.result;
                uploadButton.classList.add('remove-mode');
                cameraIcon.style.display = 'none';
                removeIcon.style.display = 'inline';
                uploadButton.setAttribute('title','Remove Picture');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    const monthSelect = document.getElementById('birthMonth');
    const daySelect = document.getElementById('day');
    const yearSelect = document.getElementById('birthYear');

    function updateDays() {
        const month = monthSelect.value;
        const year = yearSelect.value;
        const daysInMonth = new Date(year, month, 0).getDate();

        const selectedDay = daySelect.value;

        daySelect.innerHTML = '';

        for (let i = 1; i <= daysInMonth; i++) {
            const option = document.createElement('option');
            option.value = i.toString().padStart(2, '0');
            option.textContent = i;

            if (i == selectedDay) {
                option.selected = true;
            }

            daySelect.appendChild(option);
        }
    }

    monthSelect.addEventListener('change', updateDays);
    yearSelect.addEventListener('change', updateDays);

    updateDays();

    function hasChanges() {
        return (
            form.fname.value !== originalValues.fname ||
            form.lname.value !== originalValues.lname ||
            form.midname.value !== originalValues.midname ||
            form.sufname.value !== originalValues.sufname ||
            form.gender.value !== originalValues.gender ||
            form.bday.value !== originalValues.bday ||
            form.bmonth.value !== originalValues.bmonth ||
            form.byear.value !== originalValues.byear ||
            form.civilStatus.value !== originalValues.civilStatus ||
            form.citizenship.value !== originalValues.citizenship ||
            form.placeBirth.value !== originalValues.placeBirth ||
            form.voter.value !== originalValues.voter ||
            form.addsitio.value !== originalValues.addsitio ||
            form.contactNo.value !== originalValues.contactNo ||
            form.accemail.value !== originalValues.accemail ||
            document.getElementById('file').files.length > 0
        );
    }

    contactInput.addEventListener('input', function() {
        formatPhoneNumber(this);
    });

    function formatPhoneNumber(input) {
        var number = input.value.replace(/\D/g, '').substring(0, 11);
        var formatted = '';
        if (number.length > 0) {
            formatted += number.substring(0, 4);
            if (number.length > 4) {
                formatted += ' ' + number.substring(4, 7);
                if (number.length > 7) {
                    formatted += ' ' + number.substring(7, 11);
                }
            }
        }
        input.value = formatted;
    
        var contactNumberError = document.getElementById('contactNumberError');
        contactNumberError.style.display = number.length !== 11 ? 'block' : 'none';
    }
});