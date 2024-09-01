// console.log('JavaScript is running');


// document.getElementById('post_media').addEventListener('change', function(event) {
//     let files = Array.from(event.target.files); // Convert file list to an array
//     const previewContainer = document.getElementById('preview-container');
//     previewContainer.innerHTML = '';

//     function updateFileInput(newFiles) {
//         const dataTransfer = new DataTransfer();
//         newFiles.forEach(file => dataTransfer.items.add(file));
//         document.getElementById('post_media').files = dataTransfer.files;
//     }

//     function renderPreview() {
//         previewContainer.innerHTML = '';
//         files.forEach((file, index) => {
//             const previewItem = document.createElement('div');
//             previewItem.className = 'preview-item';  

//             if (file.type.startsWith('image/')) {
//                 const img = document.createElement('img');
//                 img.src = URL.createObjectURL(file);
//                 previewItem.appendChild(img);
//             } else if (file.type.startsWith('video/')) {
//                 const video = document.createElement('video');
//                 video.src = URL.createObjectURL(file);
//                 video.controls = true;
//                 previewItem.appendChild(video);
//             }
        
//             const removeBtn = document.createElement('button');
//             removeBtn.textContent = 'x';
//             removeBtn.className = 'remove-btn';
//             previewItem.appendChild(removeBtn);
        
//             previewContainer.appendChild(previewItem);
//         });
//     }

//     // function renderPreview() {
//     //     previewContainer.innerHTML = '';
//     //     files.forEach((file, index) => {
//     //         const previewItem = document.createElement('div');
//     //         previewItem.className = 'preview-item';  // Use the unified preview-item class
//     //         console.log('Created preview item:', previewItem); // Log to check
    
//     //         if (file.type.startsWith('image/')) {
//     //             const img = document.createElement('img');
//     //             img.src = URL.createObjectURL(file);
//     //             previewItem.appendChild(img);
//     //         } else if (file.type.startsWith('video/')) {
//     //             const video = document.createElement('video');
//     //             video.src = URL.createObjectURL(file);
//     //             video.controls = true;
//     //             previewItem.appendChild(video);
//     //         }
    
//     //         const removeBtn = document.createElement('button');
//     //         removeBtn.textContent = 'X';
//     //         removeBtn.className = 'remove-btn';
//     //         previewItem.appendChild(removeBtn);
    
//     //         previewContainer.appendChild(previewItem);
//     //     });
//     // }
    
//     // console.log('JavaScript is running');

        

//     renderPreview();
// });

document.getElementById('post_media').addEventListener('change', function(event) {
    let files = Array.from(event.target.files);
    const previewContainer = document.getElementById('preview-container');
    previewContainer.innerHTML = '';

    function updateFileInput(newFiles) {
        const dataTransfer = new DataTransfer();
        newFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('post_media').files = dataTransfer.files;
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
            removeBtn.textContent = '×';
            removeBtn.className = 'remove-btn';
            removeBtn.addEventListener('click', () => {
                files.splice(index, 1);
                updateFileInput(files);
                renderPreview();
            });
            previewItem.appendChild(removeBtn);

            previewContainer.appendChild(previewItem);
        });
    }

    renderPreview();
});

