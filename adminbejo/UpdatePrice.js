document.addEventListener('DOMContentLoaded', function() {
    const penIcons = document.querySelectorAll('.pen-icon');
    
    penIcons.forEach(function(penIcon) {
        penIcon.addEventListener('click', function() {
            const documentBox = penIcon.closest('.document-box');
            const documentName = documentBox.querySelector('.document-name').textContent;
            const documentPriceElement = documentBox.querySelector('.document-price span');
            const documentPrice = documentPriceElement.textContent.trim();
            const docTypeId = documentBox.getAttribute('id');

            Swal.fire({
                title: 'Update Price',
                html: `
                    <p class="document-name">Document Name: ${documentName}</p>
                    <label class="document-price" for="newPrice">Price: ₱</label>
                    <input type="number" id="newPrice" class="swal2-input" value="${documentPrice}">
                `,
                confirmButtonColor: "#3D7CC4",
                confirmButtonText: 'Update Price',
                showCloseButton: true,
                customClass: {
                    popup: 'custom-swal'
                },
                preConfirm: () => {
                    const newPrice = document.getElementById('newPrice').value;
                    if (!newPrice || newPrice <= 0) {
                        Swal.showValidationMessage('Please enter a valid price');
                        return false;
                    }
                    if (newPrice === documentPrice) {
                        Swal.showValidationMessage('New price should be different from the current price');
                        return false;
                    }
                    return newPrice;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const newPrice = result.value;
                    Swal.fire({
                        title: 'Are you sure?',
                        text: `You are about to change the price of ${documentName} to ₱${newPrice}`,
                        icon: 'warning',
                        showCancelButton: true,
                        cancelButtonColor: "#CC0000",
                        confirmButtonColor: "#3D7CC4",
                        confirmButtonText: 'Yes, update it!',
                        cancelButtonText: 'No, cancel!',
                        customClass: {
                            popup: 'custom-swal'
                        }
                    }).then((confirmResult) => {
                        if (confirmResult.isConfirmed) {
                            fetch('phpConn/update_price.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ docTypeId: docTypeId, newPrice: newPrice })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    documentPriceElement.textContent = newPrice;
                                    Swal.fire({
                                        title: 'Updated!',
                                        text: 'The price has been updated.',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        confirmButtonColor: "#3D7CC4",
                                        customClass: {
                                            popup: 'custom-swal'
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });
        });
    });
});