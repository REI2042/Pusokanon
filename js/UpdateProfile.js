document.addEventListener('DOMContentLoaded', function() {
    const updateProfileBtn = document.getElementById('updateProfileBtn');
    const fileInput = document.getElementById('file');
    const profilePreview = document.getElementById('profile-preview');
    const uploadButton = document.getElementById('upload_button');
    const cameraIcon = document.getElementById('camera-icon');
    const removeIcon = document.getElementById('remove-icon');
    let originalSrc = profilePreview.src;

    updateProfileBtn.addEventListener('click', function(event) {
        event.preventDefault();
        
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
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
});