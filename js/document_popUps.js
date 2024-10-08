document.addEventListener('DOMContentLoaded', function() {
    const tables = document.querySelectorAll('#table1, #table2, #table3');
    
    tables.forEach(table => {
        table.addEventListener('click', function(e) {
            const row = e.target.closest('tr');
            if (!row || row.parentElement.tagName === 'THEAD') return;
            
            const residentId = row.cells[0].textContent;
            
            // Show loading indicator
            Swal.fire({
                title: 'Loading...',
                text: 'Fetching resident details',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            fetch(`../adminbejo/phpConn/get_documents.php?id=${residentId}`)
                .then(response => response.json())
                .then(response => {
                    if (!response.success) {
                        throw new Error(response.error || 'Unknown error occurred');
                    }
                    
                    const data = response.data;
                    let filesHtml = '';
                    
                    if (data.attachedFiles && data.attachedFiles.length > 0) {
                        filesHtml = '<ul>' + 
                            data.attachedFiles.map(file => 
                                `<li><a href="${file.url}" target="_blank">${file.name}</a></li>`
                            ).join('') + 
                        '</ul>';
                    } else {
                        filesHtml = '<p>No files attached</p>';
                    }

                    Swal.fire({
                        title: 'Resident Details',
                        html: `
                            <div class="resident-details">
                                <p><strong>Name:</strong> ${data.residentName}</p>
                                <p><strong>Email:</strong> ${data.email}</p>
                                <p><strong>Purpose:</strong> ${data.purpose}</p>
                                <div class="attached-files">
                                    <h4>Attached Files:</h4>
                                    ${filesHtml}
                                </div>
                            </div>
                        `,
                        width: '600px',
                        showCloseButton: true,
                        showConfirmButton: false,
                        customClass: {
                            container: 'resident-popup'
                        }
                    });
                })
                .catch(error => {
                    console.error('Error fetching resident details:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Unable to fetch resident details. Please try again later.',
                        footer: `<details>
                                    <summary>Technical Details</summary>
                                    <p>${error.message}</p>
                                 </details>`
                    });
                });
        });
    });
});