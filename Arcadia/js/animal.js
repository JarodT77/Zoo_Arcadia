document.addEventListener('DOMContentLoaded', function() {
    const animalCards = document.querySelectorAll('.animal-card');

    animalCards.forEach(card => {
        card.addEventListener('click', function() {
            const animalName = this.getAttribute('data-animal-name');
            const viewCountElement = this.querySelector('.view-count');

            fetch('increment_views.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'animal_name=' + encodeURIComponent(animalName)
            })
            .then(response => response.json())
            .then(data => {
                if (data.views) {
                    viewCountElement.textContent = data.views;
                }
            });
        });
    });
});
