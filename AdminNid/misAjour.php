<?php
// Vérifier si l'ID et la description ont été soumis
if (isset($_POST['id']) && isset($_POST['description'])) {
    $id = $_POST['id'];
    $description = $_POST['description'];
    
    // Préparer les données pour la mise à jour
    $data = array(
        'description' => $description
    );
    $options = array(
        'http' => array(
            'method'  => 'PUT',
            'header'  => 'Content-type: application/json',
            'content' => json_encode($data)
        )
    );
    $context  = stream_context_create($options);
    
    // Envoyer la requête PUT à l'API pour mettre à jour le nid de poule
    $url = "http://18.223.21.80:8000/pothole-app/potholes/$id";
    $result = file_get_contents($url, false, $context);
    
    if ($result) {
        // Rediriger l'utilisateur vers la page de détails du nid de poule modifié
        header("Location: listes.php?id=$id");
    } else {
        echo "<p>Erreur : la mise à jour du nid de poule a échoué.</p>";
    }
} else {
    echo "<p>Erreur : l'ID ou la description du nid de poule n'a pas été spécifié.</p>";
}
