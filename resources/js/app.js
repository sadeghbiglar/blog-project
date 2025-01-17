import './bootstrap';



document.addEventListener('DOMContentLoaded', () => {
    const likeButtons = document.querySelectorAll('.like-button');

    likeButtons.forEach(button => {
        button.addEventListener('click', () => {
            const postId = button.getAttribute('data-post-id');

            fetch('/likes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ post_id: postId }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'liked') {
                        button.querySelector('.like-count').textContent = parseInt(button.querySelector('.like-count').textContent) + 1;
                    } else if (data.status === 'unliked') {
                        button.querySelector('.like-count').textContent = parseInt(button.querySelector('.like-count').textContent) - 1;
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    });
});
