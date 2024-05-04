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

document.addEventListener("DOMContentLoaded", initDocumentSelection);

function initDocumentSelection() {
    const buttons = document.querySelectorAll(".btn-1");
    buttons.forEach(button => {
        button.addEventListener('click', async (event) => {
            event.preventDefault();

            const { value } = await Swal.fire({
                title: "Select Purpose for requesting document",
                html: "<p>Para sa pag kuha ug Barangay Residency, kinahanglan namong mahibalo kung para asa gamitun ang documento nga Barangay residency.</p>",
                input: "select",
                inputOptions: {
                    employment: "Employment",
                    student: "Students Scholarship"
                },
                inputPlaceholder: "Select purpose",
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value === "employment") {
                            resolve();
                        } else {
                            resolve("You need to select employment :)");
                        }
                    });
                }
            });

            if (value) {
                Swal.fire({
                    title: `You selected: ${value}`,
                    icon: 'success',
                    confirmButtonText: 'OK',
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (value === "employment") {
                            window.location.href = "login.php";
                        } 
                    }
                });
            }
        });
    });
}


// async function showDetails(imageSrc, additionalData, addSitio, birthDate, contactNumber, email,  citizenship) {
//     Swal.fire({
//         title: additionalData,
//         html: `<div style="text-align: left;">
//                     <p><strong style="padding-left:15px;padding-right:15px;"> House Address:</strong>${addSitio}</p>
//                     <p><strong style="padding-left:55px;padding-right:15px;"> Birth Date:</strong>${birthDate}</p>
//                     <p><strong style="padding-left:0px;padding-right:10px;"> Contact Number:</strong> ${contactNumber}</p>
//                     <p><strong style="padding-left:95px;padding-right:15px;"> Email:</strong>${email}</p>
//                     <p><strong style="padding-left:50px;padding-right:10px;"> Citizenship:</strong> ${citizenship}</p>
//                </div>`,
//         imageUrl: imageSrc,
//         imageWidth: 400,
//         imageHeight: 200,
//         imageAlt: "Custom image",
//         customClass: {
//             confirmButton: 'gray-btn'
//         }
//     });
// }


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

$(document).ready(function() {
    $('.cancelButton').on('click', function() {
        var userEmail = $(this).data('res_email');
        var userId = $(this).data('res_ID');
        handleCancelClick(userEmail, userId);
    });
});

async function handleCancelClick(userEmail, userId) {
    const { value: text } = await Swal.fire({
        title: "Message",
        input: "textarea",
        inputLabel: "Write Message.",
        inputPlaceholder: "Type your message here...",
        inputAttributes: {
            "aria-label": "Type your message here"
        },
        showCancelButton: true,
        confirmButtonColor: '#3085d6'
    });

    if (text) {
        // Email sending code
        Email.send({
            SecureToken: "53fa4906-cb95-4a98-b24d-dc75b4225487",
            To: 'reiiiiiiii.24@gmail.com',
            From: 'reiiiiiiii.24@gmail.com',
            Subject: "Message from User",
            Body: text
        }).then(
            message => {
                // Email sent successfully, proceed with transferring user data
                $.ajax({
                    url: 'delete_user.php',
                    type: 'POST',
                    data: { id: userId },
                    success: function(transferResponse) {
                        Swal.fire({
                            title: "Email Sent and User Transferred!",
                            text: "Email sent successfully and user data transferred.",
                            icon: "success",
                            confirmButtonColor: '#3085d6'
                        });
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Transfer Failed',
                            text: 'There was an issue transferring user data.',
                            icon: 'error',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                });
            },
            error => {
                Swal.fire({
                    title: "Email Sending Failed",
                    text: "Failed to send email: " + error.message,
                    icon: "error",
                    confirmButtonColor: '#3085d6'
                });
            }
        );
    } else {
        Swal.fire({
            title: "Cancelled",
            text: "Your action has been cancelled",
            icon: "error",
            confirmButtonColor: '#3085d6'
        });
    }
}