document.addEventListener('DOMContentLoaded', function() {
    const upvoteBtn = document.querySelector('.upvote-btn');
    const downvoteBtn = document.querySelector('.downvote-btn');
    const upvoteCount = document.querySelector('.upvote-count');
    const downvoteCount = document.querySelector('.downvote-count');
    const postId = upvoteBtn.dataset.postId;

    function updateReaction(reactionType) {
        fetch('db/update_post_reaction.php', {
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
});