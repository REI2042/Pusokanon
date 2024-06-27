

document.addEventListener("DOMContentLoaded", initDocumentSelection);

async function initDocumentSelection() {
    const buttons1 = document.querySelectorAll(".btn-1");

    const purposeMap = {
        1: "Employment",
        2: "Students Scholarship",
        3: "Person With Disability Assistance",
        4: "Senior Citizen Assistance",
        5: "Other"
    };

    buttons1.forEach(button => {
        button.addEventListener('click', async (event) => {
            event.preventDefault();
            const buttonValue = event.currentTarget.dataset.value;

            const { value } = await Swal.fire({
                title: "Select Purpose for requesting document",
                html: "<p>Para sa pag kuha ug Barangay Residency, kinahanglan namong mahibalo kung para asa gamitun ang documento nga Barangay residency.</p>",
                input: "select",
                inputOptions: {
                    1: "Employment",
                    2: "Students Scholarship",
                    3: "Person With Disability Assistance",
                    4: "Senior Citizen Assistance",
                    5: "Other"
                },
                inputPlaceholder: "Select purpose",
                showCancelButton: true,
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value === "5") {
                            Swal.fire({
                                title: "Purpose",
                                input: "textarea",
                                inputLabel: "For other purpose please fill Up.",
                                inputPlaceholder: "Type your purpose here...",
                                inputAttributes: {
                                    "aria-label": "Type your purpose here"
                                },
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6'
                            }).then(({ value: otherPurpose }) => {
                                if (otherPurpose) {
                                    Swal.fire({
                                        title: "Success!",
                                        html: `Your Document Request for the Purpose of <strong>${otherPurpose}</strong> is in Process.`,
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            const formData = new FormData();
                                            formData.append('purposeId', 5);
                                            formData.append('purposeName', otherPurpose);
                                            formData.append('docTypeId', buttonValue);

                                            fetch('db/updateStatus.php', {
                                                method: 'POST',
                                                body: formData
                                            }).then(response => response.text()).then(data => {
                                                window.location.href = "Barangay-Residency.php";
                                            });
                                        }
                                    });
                                } else {
                                    resolve("You need to write your purpose :)");
                                }
                            });
                        } else {
                            resolve();
                        }
                    });
                }
            });

            if (value && value !== "5") {
                Swal.fire({
                    title: "Success!",
                    html: `Your Document Request for the Purpose of <strong>${purposeMap[value]}</strong> is in Process.`,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const formData = new FormData();
                        formData.append('purposeId', value);
                        formData.append('purposeName', purposeMap[value]);
                        formData.append('docTypeId', buttonValue);

                        fetch('db/updateStatus.php', {
                            method: 'POST',
                            body: formData
                        }).then(response => response.text()).then(data => {
                            window.location.href = "Barangay-Residency.php";
                        });
                    }
                });
            }

            // Add event listener for cancel button
            const cancelButton = Swal.getCancelButton();
            cancelButton.addEventListener('click', () => {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Are you sure you want to cancel this request?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const remarks = `Cancelled - ${purposeMap[value]}`;
                        const formData = new FormData();
                        formData.append('doc_ID', buttonValue);
                        formData.append('status', 'Cancelled');
                        formData.append('remarks', remarks);

                        fetch('../db/updateStatus.php', {
                            method: 'POST',
                            body: formData
                        }).then(response => response.json()).then(data => {
                            if (data.stat === 'success') {
                                Swal.fire({
                                    title: 'Cancelled!',
                                    text: 'Your request has been cancelled.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    // Reload the page or do any necessary actions
                                    window.location.reload();
                                });
                            } else {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while cancelling the request.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    });
}
