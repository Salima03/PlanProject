document.addEventListener("DOMContentLoaded", () => {
    const dateDebutInput = document.querySelector("#projet_dateDebut");
    const dateFinInput = document.querySelector("#projet_dateFin");

    dateDebutInput.addEventListener("change", () => {
        validateDates();
    });

    dateFinInput.addEventListener("change", () => {
        validateDates();
    });

    function validateDates() {
        const dateDebut = new Date(dateDebutInput.value);
        const dateFin = new Date(dateFinInput.value);

        if (dateDebut > dateFin) {
            alert("La date de début ne peut pas être postérieure à la date de fin.");
            dateDebutInput.value = "";
        }
    }
});
