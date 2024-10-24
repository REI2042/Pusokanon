
// show details pop up
async function showDetails(
    resident_name,
    resident_email,
    respondent_name,
    respondent_age,
    respondent_gender,
    incident_date,
    incident_time,
    incident_place,
    narrative,
    imageSrc
) {
    Swal.fire({
        title: 'Complaint Details',
        html: `<div style="text-align: left;">
                    <p><strong>Complainant:</strong> ${resident_name}</p>
                    <p><strong>Email address:</strong> ${resident_email}</p>
                    <p><strong>Details of the Respondent:</strong></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Name:</strong> ${respondent_name}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Age:</strong> ${respondent_age}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Gender:</strong> ${respondent_gender}</p>
                    <p><strong>Details of the Incident:</strong></p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Date of Incident:</strong> ${incident_date}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Time of Incident:</strong> ${incident_time}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Place of Incident:</strong> ${incident_place}</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Narrative:</strong> ${narrative}</p>
                    <p><strong>Evidence:</strong></p>
                    ${imageSrc ? `<div style="text-align: center;"><img src="${imageSrc}" alt="Evidence Image" style="max-width: 100%; height: auto; margin-top: 10px;"/></div>` : '<p>No attached evidence</p>'}
                </div>`,
        confirmButtonColor: "#3085d6",
    });
}


// comment pop up
async function viewComment (
    comment
) {

    Swal.fire({
        title: 'Complaint Comment',
        html: `<div style="text-align: left;">
                    ${comment}</p>
                    
                </div>`,
        confirmButtonColor: "#3085d6",
    });
}


// approved complaint pop up
async function approve_complaint(complaint_id) {
    // Step 1: Admin sets the hearing date and time
    const { value: dateTime } = await Swal.fire({
        title: "Set Date and Time for Hearing",
        html:
            '<input type="date" id="swal-input-date" class="swal2-input">' +
            '<input type="time" id="swal-input-time" class="swal2-input">',
        focusConfirm: false,
        didOpen: () => {
            // Get today's date
            var today = new Date();
            var day = String(today.getDate()).padStart(2, '0');
            var month = String(today.getMonth() + 1).padStart(2, '0'); 
            var year = today.getFullYear();
            var formattedDate = year + '-' + month + '-' + day;

            // Set the min attribute of the date input
            document.getElementById('swal-input-date').setAttribute('min', formattedDate);
        },
        preConfirm: () => {
            return {
                date: document.getElementById('swal-input-date').value,
                time: document.getElementById('swal-input-time').value
            }
        },
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
    });

    if (dateTime && dateTime.date && dateTime.time) {
        const hearingDate = dateTime.date;
        const hearingTime = dateTime.time;

        try {
            // Step 2: Fetch the resident email, name, and complaint ID from the PHP script and update the complaint status
            const response = await fetch('../adminbejo/phpConn/approve_complaint.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 
                    complaint_id: complaint_id,
                    hearing_date: hearingDate,
                    hearing_time: hearingTime 
                }),
            });

            const data = await response.json();

            if (data.success) {
                const decryptedEmail = data.resident_email;
                const residentName = data.resident_name;
                const complaintId = data.complaint_id;

                // Log the fetched information
                console.log("Fetched decrypted resident email: ", decryptedEmail);
                console.log("Fetched resident name: ", residentName);
                console.log("Fetched complaint ID: ", complaintId);
                console.log("Fetched hearing time: ", hearingTime);


                // Validate the email format
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(decryptedEmail)) {
                    Swal.fire({
                        title: "Error",
                        text: "The fetched email address is invalid: " + decryptedEmail,
                        icon: "error",
                        confirmButtonColor: "#3085d6",
                    });
                    return;
                }

                // Step 3: Send the email
                emailjs.send('service_e9wn0es', 'template_vr2qyso', {
                    to_email: decryptedEmail,
                    date: hearingDate,
                    time: hearingTime,
                    name: data.resident_name,
                    complaint_id: data.complaint_id,
                    respondent: data.respondent_name,
                    complaint: data.complaint,
                    month: data.hearing_month,
                    day: data.hearing_day,
                    year: data.hearing_year
                }).then(
                    function(response) {
                        console.log("EmailJS Response:", response);
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Complaint Approved",
                            text: "Email sent successfully and hearing date/time set.",
                            showConfirmButton: false,
                            timer: 1500
                          
                        }).then(() => {
                            location.reload(); // Reload the page
                        });
                    },
                    function(error) {
                        console.log("EmailJS Error:", error);
                        Swal.fire({
                            title: "Error",
                            text: "Failed to send email: " + error.text,
                            icon: "error",
                            confirmButtonColor: "#3085d6",
                        });
                    }
                );
                

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
                text: "Failed to process request: " + error.message,
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

// rejected complaint pop up
async function reject_complaint(complaint_id) {
    // Step 1: Admin provides reason for disapproval
    const { value: reason } = await Swal.fire({
        title: "Reason for Rejecting",
        input: 'textarea',
        inputLabel: 'Please provide a reason for rejecting the complaint',
        inputPlaceholder: 'Enter your reason here...',
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: 'Okay',
        cancelButtonText: 'Cancel',
        inputValidator: (value) => {
            if (!value) {
                return 'You need to provide a reason for rejecting!'
            }
        }
    });

    if (reason) {
        try {
            // Step 2: Update the complaint status and fetch the resident email and other details
            const response = await fetch('../adminbejo/phpConn/reject_complaint.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 
                    complaint_id: complaint_id,
                    reason: reason
                }),
            });

            const data = await response.json();

            if (data.success) {
                const decryptedEmail = data.to_email;  
                const residentName = data.name;        
                const dateFiled = data.date_filed;
                const caseType = data.case_type;
            
                // Validate the email format
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(decryptedEmail)) {
                    Swal.fire({
                        title: "Error",
                        text: "The fetched email address is invalid: " + decryptedEmail,
                        icon: "error",
                        confirmButtonColor: "#d33",
                    });
                    return;
                }
            
                // Step 3: Send the email
                emailjs.send('service_e9wn0es', 'template_kpcbfsq', {
                    to_email: decryptedEmail,
                    name: residentName,
                    complaint_id: data.complaint_id, 
                    respondent: data.respondent_name,
                    date_filed: dateFiled,
                    case_type: caseType,              
                    reason: data.reason               
                }).then(
                    function(response) {
                        console.log("EmailJS Response:", response);
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: "Complaint Rejected",
                            text: "Email sent successfully.",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload(); // Reload the page
                        });
                    },
                    function(error) {
                        console.log("EmailJS Error:", error);
                        Swal.fire({
                            title: "Error",
                            text: "Failed to send email: " + error.text,
                            icon: "error",
                            confirmButtonColor: "#d33",
                        });
                    }
                );

            } else {
                Swal.fire({
                    title: "Error",
                    text: data.message,
                    icon: "error",
                    confirmButtonColor: "#d33",
                });
            }
        } catch (error) {
            Swal.fire({
                title: "Error",
                text: "Failed to process request: " + error.message,
                icon: "error",
                confirmButtonColor: "#d33",
            });
        }
    } else {
        Swal.fire({
            title: "Cancelled",
            text: "Your action has been cancelled",
            icon: "error",
            confirmButtonColor: "#d33",
        });
    }
}









    













  




