document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const dateDebutInput = document.querySelector('#projet_dateDebut');
    const dateFinInput = document.querySelector('#projet_dateFin');

    form.addEventListener('submit', (e) => {
        const dateDebut = new Date(dateDebutInput.value);
        const dateFin = new Date(dateFinInput.value);

        if (dateDebut > dateFin) {
            e.preventDefault();
            alert('La date de début ne peut pas être supérieure à la date de fin.');
        }
    });
});
