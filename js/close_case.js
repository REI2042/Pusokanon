async function closeCase(complaint_id, remarks, hearing_date) {
    console.log("Function called with:", { complaint_id, remarks, hearing_date });

    // Check if the case is already closed
    if (remarks === 'CASE CLOSED') {
        Swal.fire({
            title: 'Already Closed',
            text: "This case is already closed.",
            icon: 'info',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Check if the hearing date is valid
    if (!hearing_date || hearing_date === 'undefined' || hearing_date === '') {
        console.error("Invalid hearing date:", hearing_date);
        Swal.fire({
            title: 'Error',
            text: "Unable to process the hearing date. Please contact support.",
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Parse dates
    const currentDate = new Date();
    const [year, month, day] = hearing_date.split('-').map(Number);
    const hearingDate = new Date(year, month - 1, day); // Note: month is 0-indexed in JavaScript Date

    console.log("Current date:", currentDate);
    console.log("Hearing date:", hearingDate);

    // Check if the hearing date is valid after parsing
    if (isNaN(hearingDate.getTime())) {
        console.error("Invalid hearing date after parsing:", hearing_date);
        Swal.fire({
            title: 'Error',
            text: "The hearing date is invalid. Please contact support.",
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        return;
    }

    // Check if the hearing date has passed
    if (currentDate < hearingDate) {
        Swal.fire({
            title: 'Cannot Close Yet',
            text: "The case cannot be closed until the hearing date has passed.",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
        return;
    }

    // If we've reached this point, proceed with asking for the closing reason
    const { value: reason } = await Swal.fire({
        title: "Reason for Closing",
        input: 'textarea',
        inputLabel: 'Please provide a reason for closing the case (optional)',
        inputPlaceholder: 'Enter your reason here...',
        showCancelButton: true,
        confirmButtonColor: "#d33",
        confirmButtonText: 'Close Case',
        cancelButtonText: 'Cancel'
    });

    console.log("Reason provided:", reason);

    if (reason !== undefined) {
        try {
            const response = await fetch('../adminbejo/phpConn/close_complaint.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    complaint_id: complaint_id,
                    remarks: 'CASE CLOSED',
                    comment: reason || '' // Use an empty string if no reason is provided
                }),
            });

            const result = await response.json();
            console.log("Server response:", result);

            if (result.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Case Closed',
                    text: 'The case has been successfully closed.',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Refresh the page to reflect the changes
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error closing the case. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        } catch (error) {
            console.error("Error during fetch:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an error closing the case. Please try again.',
                confirmButtonText: 'OK'
            });
        }
    }
}