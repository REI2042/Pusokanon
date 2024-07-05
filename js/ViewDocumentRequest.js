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
                showCancelButton: true,
                cancelButtonText: 'Close',
                confirmButtonText: 'Download QR Code',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33'
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
});