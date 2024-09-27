
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
                              <input type="file" id="file-input" class="file-input" accept="image/*,application/pdf" multiple style="display:none;">
                              <span class="file-name"></span>
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
                              Upload Files</button>
                          </div>
                      </div>
                  `,
                  showCancelButton: true,
                  confirmButtonText: 'Submit',
                  showLoaderOnConfirm: true,
                  preConfirm: () => {
                      const fileInput = document.querySelector('.file-input');
                      const files = Array.from(fileInput.files);
                      if (files.length === 0) {
                          Swal.showValidationMessage('Please select at least one file to upload');
                      }
                      return files;
                  },
                  didOpen: () => {
                      const uploadBtn = document.querySelector('.upload-btn');
                      const fileInput = document.querySelector('.file-input');
                      const fileName = document.querySelector('.file-name');
  
                      uploadBtn.addEventListener('click', () => {
                          fileInput.click();
                      });
  
                      fileInput.addEventListener('change', (event) => {
                          const files = event.target.files;
                          if (files.length > 0) {
                              fileName.textContent = Array.from(files).map(file => file.name).join(', ');
                          }
                      });
                  },
                  allowOutsideClick: () => !Swal.isLoading()
              }).then((fileResult) => {
                  if (fileResult.isConfirmed) {
                      var formData = new FormData();
                      fileResult.value.forEach((file) => {
                          formData.append('fileNames[]', file); // Use 'fileNames[]' for multiple files
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
                                  icon: 'success',
                                  title: 'Request Submitted',
                                  text: 'Your document request and files have been uploaded successfully.',
                                  showConfirmButton: false,
                                  timer: 2000
                              }).then(() => {
                                  window.location.href = 'db/generateQR.php';
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
          }
      });
    });
  
    $('.btn-5, .btn-6, .btn-7, .btn-8').on('click', function(e) {
      e.preventDefault();
      var docTypeId = $(this).data('value');
      var docName = $(this).data('doc-name');
  
      Swal.fire({
          title: docName,
          input: 'text',
          html: `<span style="text-align: center;">For what purpose are you getting a <b>${docName}</b> ?</span>`,
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
                                  +</button>
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
                          formData.append('fileNames[]', file); // Use 'fileNames[]' for multiple files
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
                                  icon: 'success',
                                  title: 'Request Submitted',
                                  text: 'Your document request and files have been uploaded successfully.',
                                  showConfirmButton: false,
                                  timer: 2000
                              }).then(() => {
                                  window.location.href = 'db/generateQR.php';
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
  