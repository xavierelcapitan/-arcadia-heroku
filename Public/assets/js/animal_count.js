document.addEventListener('DOMContentLoaded', function () {
    const animalLinks = document.querySelectorAll('.animal-link');

    animalLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            const animalId = this.dataset.id;
            const targetUrl = this.href;

            // Empêcher temporairement la redirection
            event.preventDefault();

            // Envoi d'une requête POST pour incrémenter les vues
            fetch(`/index.php?controller=publicAnimal&action=incrementView&id=${animalId}`, {
                method: 'POST',
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirige vers la page de détails après la mise à jour
                        window.location.href = targetUrl;
                    } else {
                        console.error('Erreur lors de l\'incrémentation des vues', data.error);
                        // Redirection même en cas d'erreur pour ne pas bloquer l'utilisateur
                        window.location.href = targetUrl;
                    }
                })
                .catch(error => {
                    console.error('Erreur AJAX :', error);
                    // Redirection même en cas d'erreur pour ne pas bloquer l'utilisateur
                    window.location.href = targetUrl;
                });
        });
    });
});
