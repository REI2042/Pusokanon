// JavaScript code
document.querySelectorAll('.btn-success').forEach(function(button) {
    button.addEventListener('click', function(event) {
        event.preventDefault();

        const formData = new FormData(this.closest('form'));
        const doc_ID = formData.get('doc_ID');
        const resident_id = formData.get('resident_id');

        // Show a file save dialog to the user
        const saveFileDialog = window.showSaveFilePicker({
            suggestedName: 'output_document.docx',
            types: [{
                description: 'Word Document',
                accept: {
                    'application/vnd.openxmlformats-officedocument.wordprocessingml.document': ['.docx']
                }
            }]
        });

        saveFileDialog.then(async fileHandle => {
            // Send a request to generate the document
            const response = await fetch('db/generate_document.php', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.stat === 'success') {
                // Get the file contents from the server
                const fileResponse = await fetch(data.download_link);
                const fileBlob = await fileResponse.blob();

                // Write the file to the user's selected folder
                const writableStream = await fileHandle.createWritable();
                await writableStream.write(fileBlob);
                await writableStream.close();

                // Update the status to 'Processing'
                const statusFormData = new FormData();
                statusFormData.append('doc_ID', doc_ID);
                statusFormData.append('status', 'Processing');
                statusFormData.append('resident_id', resident_id);

                const statusResponse = await fetch('db/updateStatus.php', {
                    method: 'POST',
                    body: statusFormData
                });

                const statusData = await statusResponse.json();

                if (statusData.stat === 'success') {
                    // Reload the page or perform any other necessary actions
                    window.location.reload();
                } else {
                    alert('Error updating status: ' + statusData.message);
                }
            } else {
                alert('Error generating document: ' + data.message);
            }
        }).catch(error => {
            console.error('Error opening file save dialog:', error);
        });
    });
});