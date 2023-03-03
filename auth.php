<!DOCTYPE html>
<html>
  <head>
    <title>Page d'authentification</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <?php
      if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Vérification des informations d'authentification
        if($username == "test" && $password == "test") {
        header('Location: map.php');

        } else {
          echo "Nom d'utilisateur ou mot de passe incorrect";
        }
      }
    ?>
    <div class="login-box">
      <h2>Connexion</h2>
      <form method="POST" action="">
        <div class="user-box">
          <input type="text" name="username" required="">
          <label>Nom d'utilisateur</label>
        </div>
        <div class="user-box">
          <input type="password" name="password" required="">
          <label>Mot de passe</label>
        </div>
        <input type="submit" name="submit" value="Connexion">
      </form>
    </div>
  </body>
</html>