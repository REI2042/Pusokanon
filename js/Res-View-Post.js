document.addEventListener('DOMContentLoaded', function() {
    const upvoteBtn = document.querySelector('.upvote-btn');
    const downvoteBtn = document.querySelector('.downvote-btn');
    const upvoteCount = document.querySelector('.upvote-count');
    const downvoteCount = document.querySelector('.downvote-count');
    const postId = upvoteBtn.dataset.postId;

    function updateReaction(reactionType) {
        fetch('db/update_reaction.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `post_id=${postId}&reaction_type=${reactionType}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                upvoteCount.textContent = data.upvotes;
                downvoteCount.textContent = data.downvotes;
                // Update button and icon styles
                if (data.userReaction === 'upvote') {
                    upvoteBtn.classList.add('active');
                    downvoteBtn.classList.remove('active');
                } else if (data.userReaction === 'downvote') {
                    downvoteBtn.classList.add('active');
                    upvoteBtn.classList.remove('active');
                } else {
                    upvoteBtn.classList.remove('active');
                    downvoteBtn.classList.remove('active');
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    upvoteBtn.addEventListener('click', () => updateReaction('upvote'));
    downvoteBtn.addEventListener('click', () => updateReaction('downvote'));

    document.addEventListener('click', function(event) {
        const navbar = document.getElementById('mainNavbar');
        const navbarToggler = document.querySelector('.navbar-toggler');
        const navbarCollapse = document.querySelector('.navbar-collapse');
    
        if (!navbar.contains(event.target) && navbarCollapse.classList.contains('show')) {
            navbarToggler.click();
        }
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
                    fetch('db/delete_comment_announcement.php', {
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