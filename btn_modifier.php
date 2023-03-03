<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Modifier le nid de poule</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Modifier le nid de poule</h1>

    <?php
    // Vérifier si l'ID du nid de poule a été spécifié
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Récupérer les informations sur le nid de poule depuis l'API
        $url = "http://18.223.21.80:8000/pothole-app/potholes/$id";
        $data = file_get_contents($url);
        $pothole = json_decode($data, true);

        // Afficher le formulaire pré-rempli avec les informations actuelles du nid de poule
    ?>
        <form action="misAjour.php" method="post">
            <input type="hidden" name="id" value="<?php echo $pothole['id']; ?>">
            <label>Images :</label>
            <input type="text" name="description" value="<?php echo $pothole['pot_photo']; ?>">
            <br>
            <input type="submit" value="Enregistrer">
            <input type="button" value="Annuler" onclick="history.back();">
        </form>
    <?php
    } else {
        echo "<p>Erreur : l'ID du nid de poule n'a pas été spécifié.</p>";
    }
    ?>

</body>

</html>