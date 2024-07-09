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

async function handleApproveClick(complaintId, residentEmail) {
    const { value: date } = await Swal.fire({
      title: "Set Hearing Date",
      input: "text",
      inputLabel: "Enter the hearing date (YYYY-MM-DD)",
      inputPlaceholder: "YYYY-MM-DD",
      inputAttributes: {
        "aria-label": "Type the hearing date here"
      },
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
    });
  
    if (date) {
      const preMessage = "Dear Resident,\n\nYour complaint has been approved. The hearing is scheduled on: ";
      const fullMessage = preMessage + date + ".\n\nThank you.";
  
      Email.send({
        SecureToken: "53fa4906-cb95-4a98-b24d-dc75b4225487",
        To: residentEmail,
        From: "peace.mari@gmail.com",
        Subject: "Complaint Hearing Date",
        Body: fullMessage,
      }).then(
        (message) => {
          $.ajax({
            url: "handleApproval.php",
            type: "POST",
            data: { complaintId: complaintId, date: date, email: residentEmail },
            success: function (response) {
              const res = JSON.parse(response);
              if (res.success) {
                Swal.fire({
                  title: "Success!",
                  text: "Email sent successfully and complaint approved.",
                  icon: "success",
                  confirmButtonColor: "#3085d6",
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire({
                  title: "Error",
                  text: res.message,
                  icon: "error",
                  confirmButtonColor: "#3085d6",
                });
              }
            },
            error: function () {
              Swal.fire({
                title: "Approval Failed",
                text: "There was an issue with the approval process.",
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
  




