<?php

// Récupérer les données JSON depuis l'API
$url = "http://18.223.21.80:8000/pothole-app/potholes/";
$data = file_get_contents($url);

// Convertir les données JSON en tableau PHP
$potholes = json_decode($data, true);

// Initialiser la variable qui stockera le code JavaScript pour la carte Mapbox
$map = '';

// Générer le code JavaScript pour chaque marqueur
foreach ($potholes as $pothole) {
    $lat = $pothole['pot_latitude'];
    $lng = $pothole['pot_longitude'];
    $description = $pothole['pot_photo'];

    $map .= "new mapboxgl.Marker().setLngLat([$lng, $lat]).setPopup(new mapboxgl.Popup().setHTML('$description')).addTo(map);\n";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Carte des nids de poule</title>
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>
        #bouton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px;
            background-color: blue;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div id='map'></div>
    <button id="bouton">Listes</button>
    <script type="text/javascript">
        document.getElementById("bouton").addEventListener("click", function() {
            window.location.href = "listes.php";
        });
    </script>
    <script>
        // Initialiser la carte
        mapboxgl.accessToken = 'pk.eyJ1IjoieW91YmV5b3UiLCJhIjoiY2xkN3ZlZXljMW5hbTNubW1lZmtoM2tsciJ9.tra-LL5GDEIkYZPA_XCCnw';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-4.008256, 5.359952],
            zoom: 12,
        });


        // Ajouter les marqueurs
        <?php echo $map; ?>

        // Ajuster la taille de la carte pour remplir tout l'écran
        map.on('load', function() {
            map.resize();
        });
    </script>
</body>

</html>