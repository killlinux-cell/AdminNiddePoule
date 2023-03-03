<?php
session_start();

$username = "test";
$password = "test";
$errors = array();

/* $dsn = 'mysql:host=localhost;dbname=';
$user = 'root';
$pass = '';
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

try {
    $db = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo "Connexion échouée : " . $e->getMessage();
} */

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username)) {
        array_push($errors, "Nom d'utilisateur requis");
    }
    if (empty($password)) {
        array_push($errors, "Mot de passe requis");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username=:username AND password=:password";
        $stmt = $db->prepare($query);
        $stmt->execute(array(':username' => $username, ':password' => $password));
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $_SESSION['username'] = $result['username'];
            $_SESSION['success'] = "Vous êtes maintenant connecté";
            header('location: map.php');
        } else {
            array_push($errors, "Combinaison nom d'utilisateur/mot de passe incorrecte");
        }
    }
}
