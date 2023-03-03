<!DOCTYPE html>
<html>

<head>
    <title>Liste des nids de poule</title>
    <meta charset='utf-8' />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
        }

        h1 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            margin: 20px auto;
            background-color: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        td.actions {
            white-space: nowrap;
        }

        td.actions button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
            margin-right: 5px;
        }

        td.actions button.edit {
            background-color: #2196F3;
        }

        td.actions button.delete {
            background-color: #f44336;
        }

        td.actions button:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <h1>Liste des nids de poule</h1>
    <?php
    require_once('functions.php');
    $link = "http://18.223.21.80:8000";

    // Récupérer les données depuis la base de données
    $potholes = get_potholes();

    // Afficher les marqueurs dans un tableau HTML
    echo "<table>";
    echo "<tr><th>ID</th><th>Latitude</th><th>Longitude</th><th>Images</th><th>Status</th><th>Actions</th></tr>";

    foreach ($potholes as $pothole) {
        $id = $pothole['id'];
        $lat = $pothole['pot_latitude'];
        $lng = $pothole['pot_longitude'];
        $img = $pothole['pot_photo'];
        $status = $pothole['status'];

        /* echo "<tr><td>$id</td><td>$lat</td><td>$lng</td><td>$img</td><td>$status</td><td class='actions'>"; */
        echo "<tr><td>$id</td><td>$lat</td><td>$lng</td><td><img src='$link$img' width='100'></td><td>$status</td><td class='actions'>";
        echo "<button class='edit' onclick='editPothole($id, \"$img\")'>Modifier</button>";
        echo "<button class='delete' onclick='deletePothole($id)'>Supprimer</button>";
        echo "</td></tr>";
    }
    echo "</table>";

   
    ?>
    <script src="script.js">
        function editPothole(id, description) {
            // TODO: Ouvrir un formulaire de modification pour le nid de poule spécifié
            console.log(`Modifier le nid de poule ${id} : ${description}`);
        }

        function deletePothole(id) {
            // TODO: Envoyer une requête DELETE pour supprimer le nid de poule spécifié
            console.log(`Supprimer le nid de poule ${id}`);
        }
    </script>
</body>

</html>