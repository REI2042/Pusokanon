// function editHearing(complaintId, currentDate, currentTime) {
//     Swal.fire({
//         title: 'Edit Hearing',
//         html:
//             '<input id="swal-input1" class="swal2-input" placeholder="New hearing date (YYYY-MM-DD)" value="' + currentDate + '">' +
//             '<input id="swal-input2" class="swal2-input" placeholder="New hearing time (HH:MM)" value="' + currentTime + '">',
//         focusConfirm: false,
//         preConfirm: () => {
//             return [
//                 document.getElementById('swal-input1').value,
//                 document.getElementById('swal-input2').value
//             ]
//         }
//     }).then((result) => {
//         if (result.isConfirmed) {
//             const [newDate, newTime] = result.value;
//             if (newDate && newTime) {
//                 // JSON data to update the hearing date and time
//                 var data = {
//                     complaint_id: complaintId,
//                     hearing_date: newDate,
//                     hearing_time: newTime
//                 };

//                 // Fetch API to send JSON data
//                 fetch('../adminbejo/phpConn/update_hearing.php', {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json'
//                     },
//                     body: JSON.stringify(data)
//                 })
//                 .then(response => {
//                     if (!response.ok) {
//                         throw new Error('Network response was not ok');
//                     }
//                     return response.json();
//                 })
//                 .then(result => {
//                     if (result.status === 'success') {
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'Success',
//                             text: 'Hearing date and time updated successfully',
//                         }).then(() => {
//                             location.reload();
//                         });
//                     } else {
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Error',
//                             text: result.message || 'Failed to update hearing date and time',
//                         });
//                     }
//                 })
//                 .catch(error => {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: 'An error occurred while updating hearing date and time: ' + error.message,
//                     });
//                     console.error('Error:', error);
//                 });
//             }
//         }
//     });
// }


async function editHearing(complaintId, currentDate, currentTime) {
    console.log('editHearing called with:', { complaintId, currentDate, currentTime });

    Swal.fire({
        title: 'Edit Hearing',
        html:
            '<input id="swal-input1" class="swal2-input" placeholder="New hearing date (YYYY-MM-DD)" value="' + currentDate + '">' +
            '<input id="swal-input2" class="swal2-input" placeholder="New hearing time (HH:MM)" value="' + currentTime + '">',
        focusConfirm: false,
        preConfirm: () => {
            return [
                document.getElementById('swal-input1').value,
                document.getElementById('swal-input2').value
            ]
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const [newDate, newTime] = result.value;
            console.log('New date and time:', { newDate, newTime });

            if (newDate && newTime) {
                var data = {
                    complaint_id: complaintId,
                    hearing_date: newDate,
                    hearing_time: newTime
                };
                console.log('Data being sent for update:', data);

                fetch('../adminbejo/phpConn/update_hearing.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    console.log('Update response status:', response.status);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(result => {
                    console.log('Update result:', result);
                    if (result.status === 'success') {
                        console.log("Full data received:", result);
                        
                        // Check if we have the necessary email data
                        if (!result.resident_email || !result.resident_name) {
                            throw new Error('Email data is missing from the response');
                        }

                        const decryptedEmail = result.resident_email;
                        const residentName = result.resident_name;

                        console.log("Resident's email:", decryptedEmail);
                        console.log("Resident's name:", residentName);

                        console.log("Validating email:", decryptedEmail);
                        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailPattern.test(decryptedEmail)) {
                            throw new Error("The fetched email address is invalid: " + decryptedEmail);
                        }

                        console.log("Preparing to send email with EmailJS");
                        emailjs.send('service_e9wn0es', 'template_vr2qyso', {
                            to_email: decryptedEmail,
                            date: newDate,
                            time: newTime,
                            name: residentName,
                            complaint_id: complaintId,
                            respondent: result.respondent_name,
                            complaint: result.complaint,
                            month: result.hearing_month,
                            day: result.hearing_day,
                            year: result.hearing_year
                        }).then(
                            function(response) {
                                console.log("EmailJS Response:", response);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Hearing date and time updated successfully and email sent',
                                }).then(() => {
                                    console.log("Reloading page after successful update");
                                    location.reload();
                                });
                            },
                            function(error) {
                                console.log("EmailJS Error:", error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Hearing date and time updated successfully but failed to send email: ' + error.text,
                                });
                            }
                        );
                    } else {
                        throw new Error(result.message || 'Failed to update hearing date and time');
                    }
                })
                .catch(error => {
                    console.error('Error in editHearing:', error);
                    console.error('Error stack:', error.stack);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.message,
                    });
                });
            } else {
                console.error('New date or time is missing');
            }
        } else {
            console.log('Edit hearing cancelled by user');
        }
    });
}