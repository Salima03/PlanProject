
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.delete-form').forEach(form =>
            form.addEventListener('submit', event => {
                event.preventDefault(); // Empêche la soumission immédiate du formulaire
                
                const projectId = form.dataset.id;

                // Appel AJAX pour vérifier avant suppression
                fetch(`/project/${projectId}/delete`, { method: 'POST', headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'error') {
                            alert(data.message); // Message d'erreur si des plans existent
                        } else if (confirm('Êtes-vous sûr de vouloir supprimer ce projet ?')) {
                            form.submit(); // Soumet le formulaire si tout est validé
                        }
                    });
            })
        );
    });

