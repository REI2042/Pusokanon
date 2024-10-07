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

    var actionsDiv = document.getElementById('actionsDiv');
    var actionsContainer = document.getElementById('actionsContainer');
    var originalParent1 = actionsDiv.parentNode;
    var pinnedPosts = document.getElementById('pinnedPosts');
    var originalParent2 = pinnedPosts.parentNode;
    var target = document.getElementById('this');

    if (window.innerWidth <= 768) {
        if (actionsDiv.parentNode !== actionsContainer) {
            actionsContainer.appendChild(actionsDiv);
            actionsContainer.appendChild(pinnedPosts);
            target.remove();
        }
    } else {
        if (actionsDiv.parentNode === actionsContainer) {
            originalParent1.appendChild(actionsDiv);
            originalParent2.appendChild(pinnedPosts);
            
        }
    }
   
    const showAllPinnedBtn = document.getElementById('show-all-pinned');
    const singlePinnedPost = document.getElementById('single-pinned-post');
    const allPinnedPosts = document.getElementById('all-pinned-posts');
    const chevronIcon = showAllPinnedBtn.querySelector('i');

    showAllPinnedBtn.addEventListener('click', function(e) {
        e.preventDefault();
        if (allPinnedPosts.style.display === 'none') {
            singlePinnedPost.style.display = 'none';
            allPinnedPosts.style.display = 'block';
            chevronIcon.classList.remove('bi-chevron-up');
            chevronIcon.classList.add('bi-chevron-down');
        } else {
            singlePinnedPost.style.display = 'block';
            allPinnedPosts.style.display = 'none';
            chevronIcon.classList.remove('bi-chevron-down');
            chevronIcon.classList.add('bi-chevron-up');
        }
    });
});
