
    // Remplir automatiquement la date du jour dans le champ de date
    document.addEventListener('DOMContentLoaded', (event) => {
        const dateInput = document.querySelector('#last_checkup_date');
        const today = new Date().toISOString().slice(0, 10);  // Format YYYY-MM-DD
        dateInput.value = today;
    });

