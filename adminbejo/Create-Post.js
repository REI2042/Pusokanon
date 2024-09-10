document.addEventListener('DOMContentLoaded', function() {
    let files = [];
    const fileInput = document.getElementById('post_media');
    
    document.getElementById('post_media').addEventListener('change', function(event) {
        const newFiles = Array.from(event.target.files);
        files = [...files, ...newFiles];
        updateFileInput();
        renderPreview();
    });

    function updateFileInput() {
        const dataTransfer = new DataTransfer();
        files.forEach(file => dataTransfer.items.add(file));
        fileInput.files = dataTransfer.files;
    }

    function renderPreview() {
        const previewContainer = document.getElementById('preview-container');
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
            removeBtn.textContent = '×';
            removeBtn.className = 'remove-btn';
            removeBtn.addEventListener('click', () => {
                files.splice(index, 1); 
                updateFileInput();
                renderPreview();
            });
            previewItem.appendChild(removeBtn);

            previewContainer.appendChild(previewItem);
        });
    }
});
