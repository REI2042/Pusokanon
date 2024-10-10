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
                    fetch('phpConn/delete_comment_post.php', {
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

    const approveButton = document.querySelector('.btn-success');
    if (approveButton) {
        approveButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to approve this post. This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, approve it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const postId = this.getAttribute('data-post-id');
                    approvePost(postId);
                }
            })
        });
    }

    function approvePost(postId) {
        fetch('phpConn/approve_post.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `post_id=${postId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                emailjs.send("service_d86wqzu", "template_7nnq77m", {
                    to_email: data.userEmail,
                    to_name: data.userName,
                    message: `We're excited to let you know that your post titled "${data.postTitle}" has been approved and is now visible in the forum!`
                })
                Swal.fire(
                    'Approved!',
                    'The post has been approved and the user has been notified.',
                    'success'
                ).then(() => {
                    window.location.reload();
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