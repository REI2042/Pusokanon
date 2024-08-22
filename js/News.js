document.addEventListener('DOMContentLoaded', function() {
    const posts = document.querySelectorAll('.Post');

    posts.forEach(post => {
        const upvoteBtn = post.querySelector('.upvote-btn');
        const downvoteBtn = post.querySelector('.downvote-btn');
        const upvoteCount = post.querySelector('.upvote-count');
        const downvoteCount = post.querySelector('.downvote-count');
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

        upvoteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            updateReaction('upvote');
        });
        downvoteBtn.addEventListener('click', (e) => {
            e.preventDefault();
            updateReaction('downvote');
        });
    });
});
