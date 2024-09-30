document.addEventListener('DOMContentLoaded', function() {

    const deleteButton = document.querySelector('.delete-button');

    deleteButton.addEventListener('click', function() {
        const postId = this.getAttribute('data-post-id');

        Swal.fire({
            title: 'Are you sure to delete this post?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('phpConn/delete_res_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `post_id=${postId}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Deleted!',
                            'The post has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.href = 'Residents-Forum.php';
                        });
                    } else {
                        Swal.fire(
                            'Error!',
                            data.error,
                            'error'
                        );
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire(
                        'Error!',
                        'An error occurred while processing your request.',
                        'error'
                    );
                });
            }
        });
    });
});