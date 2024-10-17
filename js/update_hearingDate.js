async function editHearing(complaintId, currentDate, currentTime) {
    console.log('editHearing called with:', { complaintId, currentDate, currentTime });

    const { value: dateTime } = await Swal.fire({
        title: "Set Date and Time for Hearing",
        html:
            '<input type="date" id="swal-input-date" class="swal2-input" value="' + currentDate + '">' +
            '<input type="time" id="swal-input-time" class="swal2-input" value="' + currentTime + '">',
        focusConfirm: false,
        didOpen: () => {
            // Get today's date
            var today = new Date();
            var day = String(today.getDate()).padStart(2, '0');
            var month = String(today.getMonth() + 1).padStart(2, '0'); // January is 0
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

        // Format the time to 12-hour format with AM/PM
        const formattedTime = new Date(`2000-01-01T${hearingTime}`).toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true
        });

        try {
            const response = await fetch('../adminbejo/phpConn/approve_complaint.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 
                    complaint_id: complaintId,
                    hearing_date: hearingDate,
                    hearing_time: hearingTime 
                }),
            });

            const data = await response.json();

            if (data.success) {
                const decryptedEmail = data.resident_email;
                const residentName = data.resident_name;
                const complaintId = data.complaint_id;

                console.log("Fetched decrypted resident email: ", decryptedEmail);
                console.log("Fetched resident name: ", residentName);
                console.log("Fetched complaint ID: ", complaintId);

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

                emailjs.send('service_e9wn0es', 'template_vr2qyso', {
                    to_email: decryptedEmail,
                    date: hearingDate,
                    time: formattedTime, // Use the formatted time here
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
                            title: "Success!",
                            text: "Email sent successfully and hearing date/time set.",
                            icon: "success",
                            confirmButtonColor: "#3085d6",
                        }).then(() => {
                            location.reload();
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