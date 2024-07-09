document.addEventListener('DOMContentLoaded', function() {
    const rows = document.querySelectorAll('.clickable-row');
    rows.forEach(row => {
        row.addEventListener('click', function() {
            const docId = this.dataset.docId;
            const docName = this.dataset.docName;
            const status = this.dataset.status;
            const dateReq = this.dataset.dateReq;
            const remarks = this.dataset.remarks;
            const purpose = this.dataset.purpose;
            const qrCode = this.dataset.qrCode;
    
            Swal.fire({
                title: 'Document Details',
                html: `
                    <img src="db/QRCODES/${qrCode}" alt="QR Code" style="width: 200px; height: 200px;">
                    <p><strong>Document ID:</strong> ${docId}</p>
                    <p><strong>Document Name:</strong> ${docName}</p>
                    <p><strong>Purpose:</strong> ${purpose}</p>
                    <p><strong>Status:</strong> ${status}</p>
                    <p><strong>Request Date:</strong> ${dateReq}</p>
                    <p><strong>Remarks:</strong> ${remarks}</p>
                `,
                showCloseButton: true,
                confirmButtonText: 'Download QR Code',
                confirmButtonColor: '#3D7CC4',
                cancelButtonColor: '#d33',
                customClass: {
                    popup: 'custom-swal'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const link = document.createElement('a');
                    link.href = `db/QRCODES/${qrCode}`;
                    link.download = `QR_Code_${docId}`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            });
        });
    });

    const complaintRows = document.querySelectorAll('.clickable-complaint');
    complaintRows.forEach(row => {
        row.addEventListener('click', function() {
            const complaintId = this.dataset.complaintId;
            const respondentName = this.dataset.respondentName;
            const respondentGender = this.dataset.respondentGender;
            const respondentAge = this.dataset.respondentAge;
            const narrative = this.dataset.narrative;

            Swal.fire({
                title: 'Complaint Details',
                html: `
                    <p><strong>Complaint ID:</strong> ${complaintId}</p>
                    <p><strong>Respondent:</strong> ${respondentName}</p>
                    <p><strong>Gender:</strong> ${respondentGender}</p>
                    <p><strong>Age:</strong> ${respondentAge}</p>
                    <p><strong>Narrative:</strong> ${narrative}</p>
                `,
                showCloseButton: true,
                showCancelButton: false,
                confirmButtonText: 'Close',
                confirmButtonColor: '#3D7CC4',
                customClass: {
                    popup: 'custom-swal'
                }
            });
        });
    });

    const requestButton = document.querySelector('.request-button');
    const complaintsButton = document.querySelector('.complaints-button');
    const documentRequestsDiv = document.getElementById('document-requests');
    const complaintsDiv = document.getElementById('complaints');

    requestButton.addEventListener('click', function() {
        documentRequestsDiv.style.display = 'block';
        complaintsDiv.style.display = 'none';
        requestButton.classList.add('active');
        complaintsButton.classList.remove('active');
    });

    complaintsButton.addEventListener('click', function() {
        documentRequestsDiv.style.display = 'none';
        complaintsDiv.style.display = 'block';
        requestButton.classList.remove('active');
        complaintsButton.classList.add('active');
    });

    function switchTab(tabName) {
        document.getElementById('document-requests').style.display = 'none';
        document.getElementById('complaints').style.display = 'none';
    
        document.getElementById(tabName).style.display = 'block';
    
        var url = new URL(window.location.href);
        url.searchParams.set('active_tab', tabName);
        window.history.pushState({}, '', url);
    
        document.querySelector('.request-button').classList.remove('active');
        document.querySelector('.complaints-button').classList.remove('active');
        if (tabName === 'document-requests') {
            document.querySelector('.request-button').classList.add('active');
        } else {
            document.querySelector('.complaints-button').classList.add('active');
        }
    }
    
    document.querySelector('.request-button').addEventListener('click', function() {
        switchTab('document-requests');
    });
    document.querySelector('.complaints-button').addEventListener('click', function() {
        switchTab('complaints');
    });
});