<?php
require_once('functions.php');

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $id = $_POST['id'];
    $status = $_POST['status'];

   /*  // Mettre à jour le statut du nid de poule dans la base de données
    update_pothole_status($id, $status); */

    // Rediriger l'utilisateur vers la page d'accueil
    header('Location: listes.php');
    exit();
} else {
    // Si le formulaire n'a pas été soumis, afficher une erreur
    echo "Une erreur s'est produite. Veuillez réessayer.";
}
?>