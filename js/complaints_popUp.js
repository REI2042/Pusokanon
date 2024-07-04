// document.addEventListener("DOMContentLoaded", initDocumentSelection);

//     async function initDocumentSelection() {
//       const submitButtons = document.querySelectorAll(".btn-submit");

//       submitButtons.forEach(button => {
//         button.addEventListener("click", function(event) {
//           event.preventDefault();

//           if (value && value !== "5") {
//             Swal.fire({
//               title: "Case has been submitted!",
//               html: `Thank you for filling up the form. You will be notified once the case is ready for hearing.`,
//               icon: "success",
//               confirmButtonText: "OK",
//             });
//           }
//         });
//       });
//     }

// document.addEventListener("DOMContentLoaded", initFormSubmission);

// function initFormSubmission() {
//   const form = document.querySelector('form');

//   form.addEventListener("submit", async function(event) {
//     event.preventDefault();

//     try {
//       const formData = new FormData(form);
//       const response = await fetch(form.action, {
//         method: form.method,
//         body: formData
//       });

//       const result = await response.json();

//       if (result.status === 'success') {
//         Swal.fire({
//           title: "Thank You!",
//           html: `
//             <p>Your complaint has been successfully submitted.</p>
//             <p>Our staff will review your complaint and take appropriate action.</p>
//             <p>You will be notified of any updates regarding your case.</p>
//           `,
//           icon: "success",
//           confirmButtonText: "OK",
//           confirmButtonColor: "#28a745",
//           footer: "<a href='#'>Need immediate assistance? Contact us</a>"
//         }).then((result) => {
//           if (result.isConfirmed) {
//             form.reset(); // Reset the form after successful submission
//           }
//         });
//       } else {
//         throw new Error(result.message || "Submission failed");
//       }
//     } catch (error) {
//       console.error('Error:', error);
//       Swal.fire({
//         title: "Error",
//         text: error.message || "There was a problem submitting your complaint. Please try again.",
//         icon: "error",
//         confirmButtonText: "OK",
//         confirmButtonColor: "#dc3545"
//       });
//     }
//   });
// }



// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.getElementById('complaintForm');
//     form.addEventListener('submit', function(e) {
//         e.preventDefault(); // Prevent the default form submission

//         // Use fetch to submit the form data
//         fetch(form.action, {
//             method: form.method,
//             body: new FormData(form)
//         })
//         .then(response => response.text())
//         .then(data => {
//             if (data.includes("Complaint submitted successfully")) {
//                 showThankYouAlert();
//             } else {
//                 showErrorAlert();
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             showErrorAlert();
//         });
//     });
// });

// function showSuccessAlert() {
//     Swal.fire({
//         title: "Thank You!",
//         html: `
//             <p>Your complaint has been successfully submitted.</p>
//             <p>Our staff will review your complaint and take appropriate action.</p>
//             <p>You will be notified of any updates regarding your case.</p>
//         `,
//         icon: "success",
//         confirmButtonText: "OK",
//         confirmButtonColor: "#28a745",
//         footer: "<a href='#'>Need immediate assistance? Contact us</a>"
//     }).then((result) => {
//         if (result.isConfirmed) {
//             document.querySelector('form').reset(); // Reset the form after successful submission
//         }
//     });
// }

// function showErrorAlert(errorMessage) {
//     Swal.fire({
//         title: "Error",
//         text: errorMessage || "There was a problem submitting your complaint. Please try again.",
//         icon: "error",
//         confirmButtonText: "OK",
//         confirmButtonColor: "#dc3545"
//     });



// document.addEventListener('DOMContentLoaded', function () {
//     const form = document.getElementById('complaintForm');

//     form.addEventListener('submit', function (event) {
//         event.preventDefault();

//         const formData = new FormData(form);

//         fetch('dbconn_complaints.php', {
//             method: 'POST',
//             body: formData
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log('Server response:', data);  // Log the entire response
//             if (data.success) {
//                 Swal.fire({
//                     title: 'Thank You!',
//                     text: data.message,
//                     icon: 'success',
//                     confirmButtonText: 'OK'
//                 });
//             } else {
//                 Swal.fire({
//                     title: 'Error!',
//                     text: data.message || 'An unexpected error occurred.',
//                     icon: 'error',
//                     confirmButtonText: 'OK'
//                 });
//             }
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             Swal.fire({
//                 title: 'Error!',
//                 text: 'An unexpected error occurred: ' + error.message,
//                 icon: 'error',
//                 confirmButtonText: 'OK'
//             });
//         });
//     });
// });

$(document).ready(function() {
    $('#complaintForm').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: '../residentComplaints.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            }
        });
    });
});