document.getElementById('complaintForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    var formData = new FormData(this);

    fetch('db/DBconn_complaints.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Complaint Submitted',
                text: data.message,
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'residentComplaints.php'; 
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: data.message,
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'An error occurred while submitting the complaint.',
            confirmButtonText: 'OK'
        });
        console.error('Error:', error);
    });
});


async function showDetails(
    resident_name,
    respondent_name,
    respondent_age,
    respondent_gender,
    incident_date,
    incident_time,
    incident_place,
    narrative
) {
    Swal.fire({
        title: 'Complaint Details',
        html: `<div style="text-align: left;">
                    <p><strong>Complainant:</strong> ${resident_name}</p>
                    <p><strong>Details of the Respondent:</strong></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Name:</strong> ${respondent_name}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Age:</strong> ${respondent_age}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Gender:</strong> ${respondent_gender}</p>
                    <p><strong>Details of the Incident:</strong></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Date of Incident:</strong> ${incident_date}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Time of Incident:</strong> ${incident_time}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Place of Incident:</strong> ${incident_place}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Narrative:</strong> ${narrative}</p>
               </div>`,
        confirmButtonColor: "#3085d6",
    });
}
  


// async function approve_complaint(complaint_id) {
//     const { value: date } = await Swal.fire({
//         title: "Set Date for Hearing",
//         input: "date",
//         inputLabel: "Select Date",
//         inputPlaceholder: "Select the date for the hearing",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//     });

//     if (date) {
//         const preMessage = `Congratulations! Your complaint has been approved.\n\nThe hearing is scheduled on ${date}.\n\n`;
//         const { value: message } = await Swal.fire({
//             title: "Additional Message",
//             input: "textarea",
//             inputLabel: "Write an additional message (optional):",
//             inputPlaceholder: "Type your message here...",
//             inputAttributes: {
//                 "aria-label": "Type your message here",
//             },
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//         });

//         const fullMessage = preMessage + (message ? message : "");

//         // Email sending code
//         Email.send({
//             SecureToken: "53fa4906-cb95-4a98-b24d-dc75b4225487",
//             To: res_email,
//             From: "renmarie153@gmail.com",
//             Subject: "Hearing Schedule for Your Complaint",
//             Body: fullMessage,
//         }).then(
//             (emailResponse) => {
//                 $.ajax({
//                     url: "../adminbejo/phpConn/approve_complaint.php",
//                     type: "POST",
//                     data: { complaint_id: complaint_id, date: date },
//                     success: function (transferResponse) {
//                         Swal.fire({
//                             title: "Success!",
//                             text: "Email sent successfully and hearing date set.",
//                             icon: "success",
//                             confirmButtonColor: "#3085d6",
//                         }).then(() => {
//                             window.location.href = "../adminbejo/complaintsList.php";
//                         });
//                     },
//                     error: function () {
//                         Swal.fire({
//                             title: "Transfer Failed",
//                             text: "There was an issue updating the complaint status.",
//                             icon: "error",
//                             confirmButtonColor: "#3085d6",
//                         });
//                     },
//                 });
//             },
//             (error) => {
//                 Swal.fire({
//                     title: "Email Sending Failed",
//                     text: "Failed to send email: " + error.message,
//                     icon: "error",
//                     confirmButtonColor: "#3085d6",
//                 });
//             }
//         );
//     } else {
//         Swal.fire({
//             title: "Cancelled",
//             text: "Your action has been cancelled",
//             icon: "error",
//             confirmButtonColor: "#3085d6",
//         });
//     }
// }

// async function approve_complaint(complaint_id) {
//     const { value: date } = await Swal.fire({
//         title: "Set Date for Hearing",
//         input: "date",
//         inputLabel: "Select Date",
//         inputPlaceholder: "Select the date for the hearing",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//     });

//     if (date) {
//         const preMessage = `Congratulations! Your complaint has been approved.\n\nThe hearing is scheduled on ${date}.\n\n`;
//         const { value: message } = await Swal.fire({
//             title: "Additional Message",
//             input: "textarea",
//             inputLabel: "Write an additional message (optional):",
//             inputPlaceholder: "Type your message here...",
//             inputAttributes: {
//                 "aria-label": "Type your message here",
//             },
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//         });

//         const fullMessage = preMessage + (message ? message : "");

//         try {
//             // Fetch the resident email from the PHP script
//             const response = await fetch('path/to/your/php/script.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify({ complaint_id: complaint_id }),
//             });

//             const data = await response.json();

//             if (data.success) {
//                 const residentEmail = data.resident_email;

//                 // Send the email
//                 await Email.send({
//                     SecureToken: "53fa4906-cb95-4a98-b24d-dc75b4225487",
//                     To: residentEmail,
//                     From: "renmarie153@gmail.com",
//                     Subject: "Hearing Schedule for Your Complaint",
//                     Body: fullMessage,
//                 });

//                 // Update the complaint status
//                 await $.ajax({
//                     url: "../adminbejo/phpConn/approve_complaint.php",
//                     type: "POST",
//                     data: { complaint_id: complaint_id },
//                 });

//                 Swal.fire({
//                     title: "Success!",
//                     text: "Email sent successfully and hearing date set.",
//                     icon: "success",
//                     confirmButtonColor: "#3085d6",
//                 }).then(() => {
//                     window.location.href = "../adminbejo/complaintsList.php";
//                 });
//             } else {
//                 Swal.fire({
//                     title: "Error",
//                     text: data.message,
//                     icon: "error",
//                     confirmButtonColor: "#3085d6",
//                 });
//             }
//         } catch (error) {
//             Swal.fire({
//                 title: "Error",
//                 text: "Failed to send email: " + error.message,
//                 icon: "error",
//                 confirmButtonColor: "#3085d6",
//             });
//         }
//     } else {
//         Swal.fire({
//             title: "Cancelled",
//             text: "Your action has been cancelled",
//             icon: "error",
//             confirmButtonColor: "#3085d6",
//         });
//     }
// }

// async function approve_complaint(complaint_id) {
//     const { value: date } = await Swal.fire({
//         title: "Set Date for Hearing",
//         input: "date",
//         inputLabel: "Select Date",
//         inputPlaceholder: "Select the date for the hearing",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//     });

//     if (date) {
//         const preMessage = `Congratulations! Your complaint has been approved.\n\nThe hearing is scheduled on ${date}.\n\n`;
//         const { value: message } = await Swal.fire({
//             title: "Additional Message",
//             input: "textarea",
//             inputLabel: "Write an additional message (optional):",
//             inputPlaceholder: "Type your message here...",
//             inputAttributes: {
//                 "aria-label": "Type your message here",
//             },
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//         });

//         const fullMessage = preMessage + (message ? message : "");

//         try {
//             // Fetch the resident email from the PHP script
//             const response = await fetch('../../adminbejo/phpConn/approve_complaint.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify({ complaint_id: complaint_id }),
//             });

//             const data = await response.json();

//             if (data.success) {
//                 const residentEmail = data.resident_email;

//                 // Send the email
//                 await Email.send({
//                     SecureToken: "53fa4906-cb95-4a98-b24d-dc75b4225487",
//                     To: residentEmail,
//                     From: "renmarie153@gmail.com",
//                     Subject: "Hearing Schedule for Your Complaint",
//                     Body: fullMessage,
//                 });

//                 // Update the complaint status
//                 await $.ajax({
//                     url: "db/Dbconn_complaints.php",
//                     type: "POST",
//                     data: { complaint_id: complaint_id },
//                 });

//                 Swal.fire({
//                     title: "Success!",
//                     text: "Email sent successfully and hearing date set.",
//                     icon: "success",
//                     confirmButtonColor: "#3085d6",
//                 }).then(() => {
//                     window.location.href = "../../adminbejo/complaintsList.php";
//                 });
//             } else {
//                 Swal.fire({
//                     title: "Error",
//                     text: data.message,
//                     icon: "error",
//                     confirmButtonColor: "#3085d6",
//                 });
//             }
//         } catch (error) {
//             Swal.fire({
//                 title: "Error",
//                 text: "Failed to send email: " + error.message,
//                 icon: "error",
//                 confirmButtonColor: "#3085d6",
//             });
//         }
//     } else {
//         Swal.fire({
//             title: "Cancelled",
//             text: "Your action has been cancelled",
//             icon: "error",
//             confirmButtonColor: "#3085d6",
//         });
//     }
// }

// async function approve_complaint(complaint_id) {
//     const { value: date } = await Swal.fire({
//         title: "Set Date for Hearing",
//         input: "date",
//         inputLabel: "Select Date",
//         inputPlaceholder: "Select the date for the hearing",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//     });

//     if (date) {
//         const preMessage = `Congratulations! Your complaint has been approved.\n\nThe hearing is scheduled on ${date}.\n\n`;
//         const { value: message } = await Swal.fire({
//             title: "Additional Message",
//             input: "textarea",
//             inputLabel: "Write an additional message (optional):",
//             inputPlaceholder: "Type your message here...",
//             inputAttributes: {
//                 "aria-label": "Type your message here",
//             },
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//         });

//         const fullMessage = preMessage + (message ? message : "");

//         try {
//             // Fetch the resident email from the PHP script
//             const response = await fetch('../adminbejo/phpConn/approve_complaint.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify({ complaint_id: complaint_id }),
//             });

//             // Check if response is JSON
//             const contentType = response.headers.get("content-type");
//             if (contentType && contentType.indexOf("application/json") !== -1) {
//                 const data = await response.json();

//                 if (data.success) {
//                     const residentEmail = data.resident_email;

//                     // Send the email
//                     try {
//                         const emailResponse = await Email.send({
//                             SecureToken: "7RJucdkATYmD5Iu8F",
//                             To: residentEmail,
//                             From: "renee.descart3z@gmail.com",
//                             Subject: "Hearing Schedule for Your Complaint",
//                             Body: fullMessage,
//                         });

//                         console.log(emailResponse); // Log the response

//                         Swal.fire({
//                             title: "Success!",
//                             text: "Email sent successfully and hearing date set.",
//                             icon: "success",
//                             confirmButtonColor: "#3085d6",
//                         }).then(() => {
//                             window.location.href = "../../adminbejo/complaintsList.php";
//                         });
//                     } catch (emailError) {
//                         console.error(emailError); // Log any errors
//                         Swal.fire({
//                             title: "Error",
//                             text: "Failed to send email: " + emailError.message,
//                             icon: "error",
//                             confirmButtonColor: "#3085d6",
//                         });
//                     }
//                 } else {
//                     Swal.fire({
//                         title: "Error",
//                         text: data.message || "An unknown error occurred",
//                         icon: "error",
//                         confirmButtonColor: "#3085d6",
//                     });
//                 }
//             } else {
//                 // If response is not JSON, display error
//                 Swal.fire({
//                     title: "Error",
//                     text: "Failed to fetch data. The server responded with an unexpected format.",
//                     icon: "error",
//                     confirmButtonColor: "#3085d6",
//                 });
//             }
//         } catch (error) {
//             Swal.fire({
//                 title: "Error",
//                 text: "Failed to process request: " + error.message,
//                 icon: "error",
//                 confirmButtonColor: "#3085d6",
//             });
//         }
//     } else {
//         Swal.fire({
//             title: "Cancelled",
//             text: "Your action has been cancelled",
//             icon: "error",
//             confirmButtonColor: "#3085d6",
//         });
//     }
// }

async function approve_complaint(complaint_id) {
    const { value: date } = await Swal.fire({
        title: "Set Date for Hearing",
        input: "date",
        inputLabel: "Select Date",
        inputPlaceholder: "Select the date for the hearing",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
    });

    if (date) {
        const preMessage = `Congratulations! Your complaint has been approved.\n\nThe hearing is scheduled on ${date}.\n\n`;
        const { value: message } = await Swal.fire({
            title: "Additional Message",
            input: "textarea",
            inputLabel: "Write an additional message (optional):",
            inputPlaceholder: "Type your message here...",
            inputAttributes: {
                "aria-label": "Type your message here",
            },
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
        });

        const fullMessage = preMessage + (message ? message : "");

        try {
            // Fetch the resident email from the PHP script
            const response = await fetch('../adminbejo/phpConn/approve_complaint.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ complaint_id: complaint_id }),
            });

            const data = await response.json();

            if (data.success) {
                const residentEmail = data.resident_email;

                // Send the email
                emailjs.send('service_e9wn0es', 'template_vr2qyso', {
                    to_email: residentEmail,
                    message: fullMessage,
                }).then(
                    function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Email sent successfully and hearing date set.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        }).then(() => {
                            window.location.href = "../../adminbejo/complaintsList.php";
                        });
                    },
                    function(error) {
                        Swal.fire({
                            title: "Error",
                            text: "Failed to send email: " + error.text,
                            icon: "error",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                );

                // Update the complaint status
                await $.ajax({
                    url: "../../adminbejo/db/Dbconn_complaints.php",
                    type: "POST",
                    data: { complaint_id: complaint_id },
                });
            } else {
                Swal.fire({
                    title: "Error",
                    text: data.message,
                    icon: "error",
                    confirmButtonColor: "#3085d6",
                });
            }
        } catch (error) {
            Swal.fire({
                title: "Error",
                text: "Failed to send email: " + error.message,
                icon: "error",
                confirmButtonColor: "#3085d6",
            });
        }
    } else {
        Swal.fire({
            title: "Cancelled",
            text: "Your action has been cancelled",
            icon: "error",
            confirmButtonColor: "#3085d6",
        });
    }
}







  




