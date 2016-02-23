<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <title>Internship Web Portal</title>
  </head>
  <body>
    <div class="container">
      <form method="post" action="Ajout-Entreprise.php">
        <h1>Inscription Entreprise</h1>
        <div>
          <label>Nom</label>
          <input type="text" placeholder="Nom" name="nom" id="">
        </div>
        <div>
          <label>Mail</label>
          <input type="text" placeholder="Mail" name="login" id="">
        </div>
        <div>
          <label>Mot de passe</label>
          <input type="password" placeholder="Mot de passe" name="mdp" id="">
        </div>
        <div>
          <label>Pays</label>
          <select name="pays">
            <option>Choisir un pays</option>
            <option value="France">France</option>
            <option value="Irlande">Irlande</option>
          </select>
        </div>
        <div>
          <label>Ville</label>
          <input type="text" placeholder="Ville" name="ville" id="">
        </div>
        <div>
          <label>Description</label>
          <input type="text" placeholder="Description" name="desc" id="">
        </div>
        <div>
          <label>Site Web</label>
          <input type="text" placeholder="Votre siteweb" name="website" id="">
        </div>
        <input type="reset" value="Supprimer">
        <input type="submit" value="S'inscrire">
      </form>
    </div>   
  </body>
</html>
