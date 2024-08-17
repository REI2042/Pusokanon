
$(document).ready(function() {
  $('.btn-2, .btn-4, .btn-9').on('click', function(e) {
      e.preventDefault();
      var docTypeId = $(this).data('value');
      var docName = $(this).find('h3').text();

      Swal.fire({
          title: 'Select Purpose',
          inputLabel: 'For what Pupose for getting a ' + docName + '?',
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

  
  $('.btn-1, .btn-3, .btn-5, .btn-6, .btn-7, .btn-8').on('click', function(e) {
      e.preventDefault();
      var docTypeId = $(this).data('value');
      var docName = $(this).find('h3').text();

      Swal.fire({
          title: docName,
          input: 'text',
          inputLabel: 'For what Pupose  getting a '+ docName,
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
                  input: 'file',
                  inputAttributes: {
                      'accept': 'image/*',
                      'aria-label': 'Upload your requirements'
                  },
                  showCancelButton: true,
                  confirmButtonText: 'Upload',
                  showLoaderOnConfirm: true,
                  preConfirm: (file) => {
                      if (!file) {
                          Swal.showValidationMessage('Please select a file to upload');
                      }
                      return file;
                  },
                  allowOutsideClick: () => !Swal.isLoading()
              }).then((fileResult) => {
                  if (fileResult.isConfirmed) {
                      var formData = new FormData();
                      formData.append('file', fileResult.value);
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
                                  text: 'Your document request has been submitted successfully.',
                                  showConfirmButton: false,
                                  timer: 1500
                              }).then(() => {
                                  window.location.href = 'db/generateQR.php';
                              });
                          } else {
                              throw new Error(result.error || 'An unknown error occurred.');
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