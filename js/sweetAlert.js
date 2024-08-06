// document.addEventListener("DOMContentLoaded", () => {
//     const buttons = document.querySelectorAll(".btn-1"); // Use querySelectorAll instead of getElementById
//     buttons.forEach(button => {
//         button.addEventListener('click', async (event) => { // Make the function async
//             event.preventDefault();

//             const { value } = await Swal.fire({ // Destructure value directly
//                 title: "Select Purpose for requesting document",
//                 html: "<p>Para sa pag kuha ug Barangay Residency, kinahanglan namong mahibalo kung para asa gamitun ang documento nga Barangay residency.</p>",
//                 input: "select",
//                 inputOptions: {
//                     employment: "Employement",
//                     student: "Students Scholarship"
//                 },
//                 inputPlaceholder: "Select purpose",
//                 showCancelButton: true,
//                 inputValidator: (value) => {
//                     return new Promise((resolve) => {
//                         if (value === "employment") {
//                             resolve();
//                         } else {
//                             resolve("You need to select employment :)");
//                         }
//                     });
//                 }
//             });

//             if (value) {
//                 Swal.fire({
//                     title: `You selected: ${value}`,
//                     icon: 'success',
//                     confirmButtonText: 'OK',
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                         if (value === "employment") {
//                             window.location.href = "login.php";
//                         }
//                     }
//                 });
//             }
//         });
//     });
// });

// document.addEventListener("DOMContentLoaded", initDocumentSelection);

// function initDocumentSelection() {
//     const buttons = document.querySelectorAll(".btn-1");
//     buttons.forEach(button => {
//         button.addEventListener('click', async (event) => {
//             event.preventDefault();

//             const { value } = await Swal.fire({
//                 title: "Select Purpose for requesting document",
//                 html: "<p>Para sa pag kuha ug Barangay Residency, kinahanglan namong mahibalo kung para asa gamitun ang documento nga Barangay residency.</p>",
//                 input: "select",
//                 inputOptions: {
//                     employment: "Employment",
//                     student: "Students Scholarship"
//                 },
//                 inputPlaceholder: "Select purpose",
//                 showCancelButton: true,
//                 inputValidator: (value) => {
//                     return new Promise((resolve) => {
//                         if (value === "employment") {
//                             resolve();
//                         } else {
//                             resolve("You need to select employment :)");
//                         }
//                     });
//                 }
//             });

//             if (value) {
//                 Swal.fire({
//                     title: `You selected: ${value}`,
//                     icon: 'success',
//                     confirmButtonText: 'OK',
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                         if (value === "employment") {
//                             window.location.href = "document.php";
//                         }
//                     }
//                 });
//             }
//         });
//     });
// }

async function showDetails(
  imageSrc,
  additionalData,
  addSitio,
  birthDate,
  contactNumber,
  email,
  citizenship
) {
  Swal.fire({
    title: additionalData,
    html: `<div style="text-align: left;">
                    <p><strong style="padding-left:15px;padding-right:15px;"> House Address:</strong>${addSitio}</p>
                    <p><strong style="padding-left:55px;padding-right:15px;"> Birth Date:</strong>${birthDate}</p>
                    <p><strong style="padding-left:0px;padding-right:10px;"> Contact Number:</strong> ${contactNumber}</p>
                    <p><strong style="padding-left:95px;padding-right:15px;"> Email:</strong>${email}</p>
                    <p><strong style="padding-left:50px;padding-right:10px;"> Citizenship:</strong> ${citizenship}</p>
               </div>`,
    imageUrl: imageSrc,
    imageWidth: 400,
    imageHeight: 200,
    imageAlt: "Custom image",
    confirmButtonColor: "#3085d6",
  });
}

// emailjs.init('-eg-XfJjgYaCKpd3Q');

// async function handleCancelClick(userEmail, userId) {
//     const { value: text } = await Swal.fire({
//         title: "Message",
//         input: "textarea",
//         inputLabel: "Write Message for Cancellation.",
//         inputPlaceholder: "Type your message here...",
//         inputAttributes: {
//             "aria-label": "Type your message here"
//         },
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#949494',
//         confirmButtonText: 'OK',
//         cancelButtonText: 'Cancel',
//     });

//     if (text) {
//         // Send email using EmailJS
//         emailjs.send('service_uhvx5cl', 'template_tv4l19k', {
//             from_email: 'reiiiiiiii.24@gmail.com',
//             to_email: 'reiiiiiiii.24@gmail.com',
//             subject: "Message from User",
//             message: text
//         }).then(
//             function(response) {
//                 // If the email is sent successfully, transfer user data
//                 $.ajax({
//                     url: 'delete_user.php', // Assuming this is the script to transfer user data
//                     type: 'POST',
//                     data: { id: userId }, // Pass the user ID to transfer
//                     success: function(transferResponse) {
//                         Swal.fire({
//                             title: "Email Sent!",
//                             text: response.text,
//                             icon: "success",
//                             confirmButtonColor: '#3085d6' // Color of the confirm button (OK button)
//                         });
//                     },
//                     error: function() {
//                         Swal.fire('Error', 'There was an issue transferring user data.', 'error');
//                     }
//                 });
//             },
//             function(error) {
//                 Swal.fire({
//                     title: "Error",
//                     text: error.text,
//                     icon: "error",
//                     confirmButtonColor: '#3085d6' // Color of the confirm button (OK button)
//                 });
//             }
//         );
//     } else {
//         Swal.fire({
//             title: "Cancelled",
//             text: "Your action has been cancelled",
//             icon: "error",
//             confirmButtonColor: '#3085d6' // Color of the confirm button (OK button)
//         });
//     }
// }

$(document).ready(function () {
  $(".cancelButton").on("click", function () {
    var userEmail = $(this).data("res_email");
    var userId = $(this).data("res_ID");
    handleCancelClick(userEmail, userId);
  });
});

//cancel button in pending user
async function handleCancelClick(userEmail, userId) {
  const result = await Swal.fire({
    title: "Are you sure?",
    text: "Do you want to cancel this user?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, cancel it!"
  });

  if (result.isConfirmed) {
    // Email sending code using EmailJS
    emailjs.send("service_26kfbyc", "template_55ezm2n", {
      to_email: userEmail,
      message: "Your registration has been cancelled due to some misinformation and incomplete information please contact the Barangay Staff for further assistance.",
    }).then(() => {
        // Email sent successfully, proceed with transferring user data
        $.ajax({
          url: "phpConn/delete_user.php",
          type: "POST",
          data: { id: userId },
          success: function () {
            Swal.fire({
              title: "Email Sent and User Cancelled!",
              text: "Email sent successfully and User Cancelled.",
              icon: "success",
              confirmButtonColor: "#3085d6",
            }).then(() => {
              window.location.href = "../adminbejo/pendingUser2.0.php";
            });
          },
          error: function () {
            Swal.fire({
              title: "Transfer Failed",
              text: "There was an issue transferring user data.",
              icon: "error",
              confirmButtonColor: "#3085d6",
            });
          },
        });
      },
      (error) => {
        Swal.fire({
          title: "Email Sending Failed",
          text: "Failed to send email: " + error.message,
          icon: "error",
          confirmButtonColor: "#3085d6",
        });
      }
    );
  } else {
    Swal.fire({
      title: "Cancelled",
      text: "Your action has been cancelled",
      icon: "error",
      confirmButtonColor: "#3085d6",
    });
  }
}


$(document).ready(function () {
  $(".approveButton").on("click", function () {
    var userEmail = $(this).data("res_email");
    var userId = $(this).data("res_ID");
    handleApproveClick(userEmail, userId);
  });
});
//handle the accept button in pending user page
async function handleApproveClick(userEmail, userId) {
  const result = await Swal.fire({
    title: "Are you sure?",
    text: "Do you want to Approve this user?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, approve it!"
  });
  if (result.isConfirmed) {
    // Email sending code using EmailJS
    emailjs.send("service_26kfbyc", "template_55ezm2n", {
      to_email: userEmail,
      message: "Your registration has been approved. Please log in to your account.",
    }).then(() => {
        $.ajax({
          url: "../adminbejo/phpConn/accept_user.php",
          type: "POST",
          data: { res_id: userId },
          success: function () {
            Swal.fire({
              title: "Success!",
              text: "Email sent successfully and user data transferred.",
              icon: "success",
              confirmButtonColor: "#3085d6",
            }).then(() => {
              window.location.href = "../adminbejo/pendingUser2.0.php";
            });
          },
          error: function () {
            Swal.fire({
              title: "Transfer Failed",
              text: "There was an issue transferring user data.",
              icon: "error",
              confirmButtonColor: "#3085d6",
            });
          },
        });
      },
      (error) => {
        Swal.fire({
          title: "Email Sending Failed",
          text: "Failed to send email: " + error.message,
          icon: "error",
          confirmButtonColor: "#3085d6",
        });
      }
    );
  } else {
    Swal.fire({
      title: "Cancelled",
      text: "Your action has been cancelled",
      icon: "error",
      confirmButtonColor: "#3085d6",
    });
  }
}

//for registerd voters update status
// Event listener for X icon click
function handleXClick(resID) {
  handleStatusUpdate(resID, "Not-registered");
}

// Event listener for Check icon click
function handleCheckClick(resID) {
  handleStatusUpdate(resID, "Registered");
}

async function handleStatusUpdate(resID, newStatus) {
  // Send an AJAX request to update the user status
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "../adminbejo/phpConn/update_reg_status.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        // Handle success
        Swal.fire({
          icon: "success",
          title: "Update Successful",
          showConfirmButton: false,
          timer: 1500,
        });
        console.log(xhr.responseText);
        setTimeout(() => {
          window.location.href = "../adminbejo/pendingUser2.0.php";
        }, 1500);
      } else {
        // Handle error
        console.error(xhr.statusText);
      }
    }
  };
  xhr.send(`resID=${resID}&newStatus=${newStatus}`);
}



//connection from updateStatus.php for adding time to update status 
async function showSweetAlert(res_email, resident_name, document_name ,docID, residentID) {
  let hours;
  Swal.fire({
      title: 'Enter number of hours needed',
      input: 'number',
      inputAttributes: {
          min: 1,
          max: 24,
          step: 1
      },
      inputLabel: 'Hours',
      showCancelButton: true,
      confirmButtonText: 'OK',
      preConfirm: (value) => {
          hours = value; // Store the input value in the hours variable
          if (!hours) {
              Swal.showValidationMessage('Please enter a valid number of hours');
              return false; // Prevent the popup from closing
          } else {
              return true; // Allow the popup to close
          }
      }
  }).then((result) => {
      if (result.isConfirmed) {
          // Create a form and submit it
          let form = document.createElement('form');
          form.action = '../db/updateStatus.php';
          form.method = 'POST';
          form.innerHTML = `
              <input type="hidden" name="doc_ID" value="${docID}">
              <input type="hidden" name="resident_id" value="${residentID}">
              <input type="hidden" name="status" value="Ready to pickup">
              <input type="hidden" name="hours" value="${hours}">
          `;
          document.body.appendChild(form);
          form.submit();

          // Send email
          emailjs.send('service_uhvx5cl', 'template_tv4l19k', {
              to_email: res_email,
              name: resident_name,
              hours: hours,
              doc_name: document_name
          }).then(() => {
              Swal.fire({
                  title: 'Status Updated',
                  text: 'Status has been updated and an email has been sent',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
              }).then(() => {
                  location.reload();
              });
          }, (error) => {
              console.error('Failed to send email:', error);
              Swal.fire({
                  title: 'Error',
                  text: 'Failed to send email',
                  icon: 'error',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
              });
          });
      }
  });
}


function trashCancelDocument(doc_ID, request_id) {
  Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        url: "../db/trashDocument.php",
        type: "POST",
        data: { 
          doc_ID: doc_ID,
          request_id: request_id
        },
        success: function (response) {
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
          setTimeout(() => {
            location.reload();
          }, 2500);
        },
        error: function (xhr, status, error) {
          Swal.fire({
            title: 'Error',
            text: 'There was an error deleting your file: ' + error,
            icon: 'error',
            confirmButtonColor: '#3085d6',
          })
        }
      });
    }
  })
}
