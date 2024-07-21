document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.side-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('data-url');
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('content').innerHTML = html;
                })
                .catch(error => console.error('Error loading content:', error));
        });
    });
});
