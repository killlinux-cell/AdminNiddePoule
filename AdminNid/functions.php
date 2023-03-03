<?php
function get_potholes()
{
    $url = "http://18.223.21.80:8000/pothole-app/potholes/";
    $data = file_get_contents($url);
    $potholes = json_decode($data, true);
    return $potholes;
}

function editPothole($id, $img) {
    // TODO: Ouvrir un formulaire de modification pour le nid de poule spécifié
    echo "Modifier le nid de poule $id : $img";
}

function deletePothole($id) {
    // TODO: Envoyer une requête DELETE pour supprimer le nid de poule spécifié
    
    echo "Supprimer le nid de poule $id";
}
