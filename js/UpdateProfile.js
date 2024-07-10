document.addEventListener('DOMContentLoaded', function() {
    const updateProfileBtn = document.getElementById('updateProfileBtn');

    updateProfileBtn.addEventListener('click', function(event) {
        event.preventDefault();
        
        Swal.fire({
            title: 'Confirm Update',
            text: "Are you sure you want to update your profile?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, update it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Updated!',
                    text: 'Profile has been updated successfully.',
                    icon: 'success',
                    confirmButtonText: 'Ok'
                }).then(() => {
                    document.querySelector('form').submit();
                });
            }
        });
    });
});

function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('profile-preview').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}