<?php
   session_start();
   session_destroy();   
   session_unset();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Connexion Entreprise</title>
  </head>
  <style type="text/css">
    html,.container,a{
      color: black;
    }
  </style>
  <body>
    <div class="container">
      <form name="login" method="POST" action="Authentification-Entreprise.php">
        <h1>Connexion Entreprise</h1>
        <div>
          <label>Mail</label>
          <input type="text" placeholder="Mail" name="login" id="">
        </div>
        <div>
          <label>Mot de passe</label>
          <input type="password" placeholder="Mot de passe" name="mdp" id="">
        </div>
        <input type="reset" value="Supprimer">
        <input type="submit" value="Se connecter">
      </form>
        <a href="Form-Inscription-Entreprise.php">Pas encore inscrit ?</a>
    </div>   
  </body>
</html>