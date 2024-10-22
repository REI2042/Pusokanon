async function testPopup() {
    const formattedTime = new Date(`2000-01-01T14:30`).toLocaleTimeString('en-US', {
        hour: 'numeric',
        minute: '2-digit',
        hour12: true
    });

    await Swal.fire({
        title: 'Debugging Info',
        text: 'Formatted Time: ' + formattedTime,
        icon: 'info',
        confirmButtonText: 'OK'
    });
}

// Call this function independently to see if it works
testPopup();
