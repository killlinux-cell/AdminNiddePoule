<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <title>Carte des nids de poule à Abidjan</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
    <style>
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
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoieW91YmV5b3UiLCJhIjoiY2xkN3ZlZXljMW5hbTNubW1lZmtoM2tsciJ9.tra-LL5GDEIkYZPA_XCCnw';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-4.0365, 5.3459], // Coordonnées du centre de Abidjan
            zoom: 11 // Zoom par défaut
        });

        // Ajouter les marqueurs pour chaque nid de poule
        fetch('http://18.223.21.80:8000/pothole-app/potholes/')
            .then(response => response.json())
            .then(data => {
                data.forEach(pothole => {
                    // Créer un marqueur pour chaque nid de poule
                    var marker = new mapboxgl.Marker({
                            color: pothole.status == 'ongoing' ? 'red' : 'blue' // Couleur du marqueur en fonction du statut
                        })
                        .setLngLat([pothole.pot_longitude, pothole.pot_latitude])
                        .addTo(map);

                    // Ajouter une popup pour afficher les informations du nid de poule
                    var popup = new mapboxgl.Popup({
                            offset: 25
                        })
                        .setHTML('<h3>' + pothole.status + '</h3><p>' + pothole.description + '</p>');
                    marker.setPopup(popup);
                });
            });
    </script>
</body>

</html>