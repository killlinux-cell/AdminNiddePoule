const potholesTable = document.querySelector('#potholes-table tbody');

// Récupérer les données depuis l'API
fetch('http://18.223.21.80:8000/pothole-app/potholes/')
	.then(response => response.json())
	.then(data => {
		// Afficher chaque élément dans un tableau HTML
		data.forEach(pothole => {
			const tr = document.createElement('tr');
			tr.innerHTML = `
				<td>${pothole.id}</td>
				<td>${pothole.pot_latitude}</td>
				<td>${pothole.pot_longitude}</td>
				<td><img src="${pothole.pot_photo}" width="100"></td>
				<td>${pothole.status}</td>
				<td class="actions">
					<button class="edit" onclick="editPothole(${pothole.id}, '${pothole.pot_photo}')">Modifier</button>
					<button class="delete" onclick="deletePothole(${pothole.id})">Supprimer</button>
				</td>
			`;
			potholesTable.appendChild(tr);
		});
	})
	.catch(error => console.error(error));

function editPothole(id, description) {
  // Créer un formulaire pour la modification du nid de poule
  let form = document.createElement('form');
  form.method = 'POST';
  form.action = 'update_pothole.php';
  
  // Ajouter un champ caché pour l'ID du nid de poule
  let idField = document.createElement('input');
  idField.type = 'hidden';
  idField.name = 'id';
  idField.value = id;
  form.appendChild(idField);
  
  // Ajouter un champ pour la description
  let descriptionLabel = document.createElement('label');
  descriptionLabel.textContent = 'Description: ';
  form.appendChild(descriptionLabel);
  
  let descriptionField = document.createElement('input');
  descriptionField.type = 'text';
  descriptionField.name = 'description';
  descriptionField.value = description;
  form.appendChild(descriptionField);
  
  // Ajouter un bouton pour soumettre le formulaire
  let submitButton = document.createElement('button');
  submitButton.type = 'submit';
  submitButton.textContent = 'Modifier';
  form.appendChild(submitButton);
  
  // Ajouter le formulaire à la page
  document.body.appendChild(form);
}


function deletePothole(id) {
  // Envoyer une requête DELETE pour supprimer le nid de poule spécifié
  const url = `http://18.223.21.80:8000/pothole-app/potholes/${id}`;
  fetch(url, {
    method: 'DELETE',
  })
  .then(response => response.json())
  .then(data => {
    // Si la suppression a réussi, recharger la page pour mettre à jour la liste
    if (data.success) {
      location.reload();
    } else {
      alert('Une erreur s\'est produite lors de la suppression du nid de poule.');
    }
  })
  .catch(error => {
    console.error('Erreur:', error);
    alert('Une erreur s\'est produite lors de la suppression du nid de poule.');
  });
}