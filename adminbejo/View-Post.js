document.addEventListener('DOMContentLoaded', function() {
    const pinButton = document.getElementById('pinPostButton');
    
    pinButton.addEventListener('click', function() {
        const postId = this.getAttribute('data-post-id');
        const isPinned = this.getAttribute('data-is-pinned') === '1';
    
        Swal.fire({
            title: 'Are you sure?',
            text: isPinned ? "Do you want to unpin this post?" : "Do you want to pin this post?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch('phpConn/pin_post.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `post_id=${postId}&pin=${isPinned ? 0 : 1}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire(
                            'Success!',
                            isPinned ? 'Post has been unpinned.' : 'Post has been pinned.',
                            'success'
                        );
                        pinButton.textContent = isPinned ? 'Pin Post' : 'Unpin Post';
                        pinButton.setAttribute('data-is-pinned', isPinned ? '0' : '1');
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
                fetch('phpConn/delete_post.php', {
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
                            'Your post has been deleted.',
                            'success'
                        ).then(() => {
                            window.location.href = 'Post-Announcements.php';
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

    document.querySelectorAll('.delete-comment-button').forEach(button => {
        button.addEventListener('click', function() {
            const commentId = this.getAttribute('data-comment-id');

            Swal.fire({
                title: 'Are you sure you want to delete this comment?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('phpConn/delete_comment_announcement.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `comment_id=${commentId}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your comment has been deleted.',
                                'success'
                            ).then(() => {
                                const commentElement = button.closest('.comment');
                                commentElement.remove();
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
});