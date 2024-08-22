document.addEventListener('DOMContentLoaded', function() {
    const postMediaInput = document.getElementById('post_media');
    const previewContainer = document.getElementById('preview-container');
    const form = document.querySelector('form');
    let files = [];

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        postMediaInput.files = dataTransfer.files;
    }

    function renderPreview() {
        previewContainer.innerHTML = '';
        files.forEach((file, index) => {
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                previewItem.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.controls = true;
                previewItem.appendChild(video);
            }

            const removeBtn = document.createElement('button');
            removeBtn.textContent = 'X';
            removeBtn.className = 'remove-btn';
            removeBtn.onclick = function() {
                files.splice(index, 1);
                renderPreview();
                updateFileInput();
            };
            previewItem.appendChild(removeBtn);

            previewContainer.appendChild(previewItem);
        });
    }

    postMediaInput.addEventListener('change', function(event) {
        files = Array.from(event.target.files);
        renderPreview();
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure you want to update this post?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, update it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData(form);

                fetch('phpConn/update_post.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Updated!',
                            'Your post has been updated.',
                            'success'
                        ).then(() => {
                            window.location.href = `View-Post.php?id=${data.post_id}`;
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            'There was a problem updating your post.',
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'There was a problem updating your post.',
                        'error'
                    );
                });
            }
        });
    });
   
});