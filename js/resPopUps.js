
$(document).ready(function() {
    $('.btn-3, .btn-2, .btn-4, .btn-9').on('click', function(e) {
        e.preventDefault();
        var docTypeId = $(this).data('value');
        var docName = $(this).data('doc-name');
  
        Swal.fire({
            title: 'Select Purpose',
            html: `<span style="text-align: center;">For what purpose are you getting a <b>${docName}</b> ?</span>`,
            input: 'select',
            inputOptions: {
                '1': 'Employment',
                '2': 'Students Scholarship',
                '3': 'Person With Disability Assistance',
                '4': 'Senior Citizen Assistance',
                '5': 'Others'
            },
            inputPlaceholder: 'Select a purpose',
            showCancelButton: true,
            inputValidator: (value) => {
                return new Promise((resolve) => {
                    if (value) {
                        resolve();
                    } else {
                        resolve('You need to select a purpose');
                    }
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var purposeId = result.value;
                var purposeName = $('select option:selected').text();
  
                if (purposeId === '5') {
                    Swal.fire({
                        title: 'Specify Other Purpose',
                        inputLabel: 'Please specify the other purpose',
                        input: 'text',
                        inputPlaceholder: 'Enter your purpose',
                        showCancelButton: true,
                        inputValidator: (value) => {
                            if (!value) {
                                return 'You need to write something!';
                            }
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            purposeName = result.value;
                            submitRequest(docTypeId, purposeId, purposeName);
                        }
                    });
                } else {
                    submitRequest(docTypeId, purposeId, purposeName);
                }
            }
        });
    });
  
    $('.btn-1').on('click', function(e) {
        e.preventDefault();
        var docTypeId = $(this).data('value');
        var docName = $(this).data('doc-name');
    
        Swal.fire({
            title: docName,
            input: 'text',
            html: `<span style="text-align: center;">For what purpose are you getting a <b>${docName}</b>?</span>`,
            inputPlaceholder: 'Enter your purpose',
            showCancelButton: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to write something!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                var purposeName = result.value;
    
                Swal.fire({
                    title: 'Upload Requirements',
                    html: `
                        <div id="upload-container">
                            <div class="upload-item" style="display: inline-block;">
                                <input type="file" id="file-input" class="file-input" accept="image/*,application/pdf" style="display:none;">
                                <div class="file-info" style="margin-bottom: 10px; display: none;">
                                    <span class="file-name" style="margin-right: 10px;"></span>
                                    <button type="button" class="remove-btn" 
                                    style="padding: 5px 10px; 
                                    border-radius: 3px; 
                                    background-color: #ff4444; 
                                    color: white; 
                                    border: none; 
                                    cursor: pointer;">
                                    <i class="fa-solid fa-x"></i></button>
                                </div>
                                <button type="button" class="upload-btn" 
                                style="width: 120px; 
                                height: 40px; 
                                border-radius: 5px; 
                                background-color: #c2c0c0; 
                                color: #696767; 
                                border: 1px solid #696767; 
                                font-size: 16px; 
                                cursor: pointer;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                text-align: center;">
                                Upload File</button>
                            </div>
                        </div>
                    `,
                    showCancelButton: true,
                    confirmButtonText: 'Submit',
                    showLoaderOnConfirm: true,
                    preConfirm: () => {
                        const fileInput = document.querySelector('.file-input');
                        const file = fileInput.files[0];
                        if (!file) {
                            Swal.showValidationMessage('Please select a file to upload');
                        }
                        return file;
                    },
                    didOpen: () => {
                        const uploadBtn = document.querySelector('.upload-btn');
                        const fileInput = document.querySelector('.file-input');
                        const fileInfo = document.querySelector('.file-info');
                        const fileName = document.querySelector('.file-name');
                        const removeBtn = document.querySelector('.remove-btn');
    
                        uploadBtn.addEventListener('click', () => {
                            fileInput.click();
                        });
    
                        fileInput.addEventListener('change', (event) => {
                            const file = event.target.files[0];
                            if (file) {
                                fileName.textContent = file.name;
                                fileInfo.style.display = 'block';
                                uploadBtn.style.display = 'none';
                            }
                        });
    
                        removeBtn.addEventListener('click', () => {
                            fileInput.value = ''; // Clear the file input
                            fileInfo.style.display = 'none';
                            uploadBtn.style.display = 'flex';
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((fileResult) => {
                    if (fileResult.isConfirmed) {
                        var formData = new FormData();
                        formData.append('fileNames[]', fileResult.value); // Changed to match PHP expectation
                        formData.append('purpose', purposeName);
                        formData.append('docTypeId', docTypeId);
    
                        fetch('db/insert_request.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.text().then(text => {
                                try {
                                    return JSON.parse(text);
                                } catch (e) {
                                    console.error('Server response:', text);
                                    throw new Error('Invalid server response');
                                }
                            });
                        })
                        .then(result => {
                            if (result.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Request Submitted',
                                    text: result.message,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    window.location.href = 'db/generateQR.php';
                                });
                            } else {
                                throw new Error(result.error || 'An error occurred while uploading file.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Submission Failed',
                                text: error.message,
                                confirmButtonText: 'OK'
                            });
                        });
                    }
                });
            }
        });
    });
    
    $('.btn-5, .btn-6, .btn-7, .btn-8').on('click', function(e) {//business clearance, and permits
        e.preventDefault();
        var docTypeId = $(this).data('value');
        var docName = $(this).data('doc-name');
        var purposeName = docName; 
    
        Swal.fire({
            title: 'Upload Requirements',
            html: `
                <div id="upload-container">
                    ${Array(5).fill().map((_, i) => `
                        <div class="upload-item" style="display: inline-block; margin-right: 10px;">
                            <input type="file" id="file-input-${i}" class="file-input" accept="image/*,application/pdf" multiple style="display:none;">
                            <span class="file-name" data-index="${i}"></span>
                            <button type="button" class="upload-btn" data-index="${i}" 
                                style="width: 40px; 
                                height: 40px; 
                                padding-bottom:10px;
                                border-radius: 10%; 
                                background-color: #c2c0c0; 
                                color: #696767; 
                                border: 1px solid #696767; 
                                font-size: 50px; 
                                line-height: 1; 
                                cursor: pointer;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                text-align: center;">
                                +
                            </button>
                        </div>
                    `).join('')}
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Upload',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                const fileInputs = document.querySelectorAll('.file-input');
                const files = Array.from(fileInputs).flatMap(input => Array.from(input.files)).filter(Boolean);
                if (files.length === 0) {
                    Swal.showValidationMessage('Please select at least one file to upload');
                }
                return files;
            },
            didOpen: () => {
                const uploadBtns = document.querySelectorAll('.upload-btn');
                const fileInputs = document.querySelectorAll('.file-input');
                const fileNames = document.querySelectorAll('.file-name');
    
                uploadBtns.forEach((btn, index) => {
                    btn.addEventListener('click', () => {
                        fileInputs[index].click();
                    });
    
                    fileInputs[index].addEventListener('change', (event) => {
                        const files = event.target.files;
                        if (files.length > 0) {
                            fileNames[index].textContent = Array.from(files).map(file => file.name).join(', ');
                            btn.style.display = 'none';
                        }
                    });
                });
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((fileResult) => {
            if (fileResult.isConfirmed) {
                var formData = new FormData();
                fileResult.value.forEach((file) => {
                    formData.append('fileNames[]', file);
                });
                formData.append('purpose', purposeName);
                formData.append('docTypeId', docTypeId);
    
                fetch('db/insert_request.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        Swal.fire({
                            title: 'Set Appointment',
                            html:
                                '<input id="swal-input1" class="swal2-input" type="date">' +
                                '<input id="swal-input2" class="swal2-input" type="time">',
                            focusConfirm: false,
                            preConfirm: () => {
                                return [
                                    document.getElementById('swal-input1').value,
                                    document.getElementById('swal-input2').value
                                ]
                            }
                        }).then((appointmentResult) => {
                            if (appointmentResult.isConfirmed) {
                                const [date, time] = appointmentResult.value;
                                fetch('db/insert_appointment.php', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({ 
                                        date, 
                                        time,
                                        request_id: result.request_id
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Request Submitted',
                                            text: 'Your document request and appointment have been set successfully.',
                                            showConfirmButton: false,
                                            timer: 2000
                                        }).then(() => {
                                            window.location.href = 'db/generateQR.php';
                                        });
                                    } else {
                                        throw new Error(data.error || 'Failed to set appointment');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error', 'Failed to set appointment', 'error');
                                });
                            }
                        });
                    } else {
                        throw new Error(result.error || 'An error occurred while uploading files.');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Submission Failed',
                        text: error.message,
                    });
                });
            }
        });
    });
    
  
   function submitRequest(docTypeId, purposeId, purposeName) {
        fetch('db/insert_request.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                docTypeId: docTypeId,
                purposeId: purposeId,
                purposeName: purposeName
            }),
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Request Submitted',
                    text: 'Your document request has been submitted successfully.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = 'db/generateQR.php';
                });
            } else {
                throw new Error(result.message || 'An unknown error occurred.');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Submission Failed',
                text: error.message,
            });
        });
    }
    });
  

    function docDetails(documentRequirements) {
        // Split the document requirements string into an array of filenames
        const fileNames = documentRequirements.split(',').map(name => name.trim());
        
        let content = '';
        
        if (fileNames.length > 0) {
            fileNames.forEach(fileName => {
                const filePath = `../db/uploaded_filesRequirements/${fileName}`;
                const fileExtension = fileName.split('.').pop().toLowerCase();
                
                if (fileExtension === 'pdf') {
                    content += `
                        <div class="mb-3">
                            <p><strong>File: ${fileName}</strong></p>
                            <embed src="${filePath}" 
                                   type="application/pdf" 
                                   width="100%" 
                                   height="500px" />
                        </div>
                    `;
                } else if (['jpg', 'jpeg', 'png', 'gif'].includes(fileExtension)) {
                    content += `
                        <div class="mb-3">
                            <p><strong>File: ${fileName}</strong></p>
                            <img src="${filePath}" 
                                 alt="Uploaded Document - ${fileName}" 
                                 style="max-width: 20%; height: auto;" />
                        </div>
                    `;
                } else {
                    content += `
                        <div class="mb-3">
                            <p><strong>File: ${fileName}</strong></p>
                            <p>Unsupported file type. Please download to view.</p>
                            <a href="${filePath}" download="${fileName}" class="btn btn-primary">Download ${fileName}</a>
                        </div>
                    `;
                }
            });
        } else {
            content = '<p>No documents attached</p>';
        }
    
        Swal.fire({
            title: 'Uploaded Documents',
            html: `
                <div style="max-height: 70vh; overflow-y: auto;">
                    ${content}
                </div>
            `,
            width: '80%',
            confirmButtonColor: "#3085d6",
            confirmButtonText: 'Close',
            showCloseButton: true,
        });
    }

    