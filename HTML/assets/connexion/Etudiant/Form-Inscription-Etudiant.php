<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Intership Webportail</title>
  </head>
  
  <body>
    <div class="container">
      <form method="post" action="Ajout-Etudiant.php" enctype="multipart/form-data">  <!--enctype spécifie l'envoie d'autres données que du texte-->
        <h1>Inscription Etudiant</h1>
        <div>
          <label>Nom</label>
          <input type="text" placeholder="Nom" name="nom" id="">
        </div>
        <div>
          <label>Prénom</label>
          <input type="text" placeholder="Prénom" name="prenom" id="">
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
          <label>Domaine de comptétences</label>
          <select name="domaine">
            <?php
              require_once('connexion.php');
              try
                {
                  $sql='select * from domaine';
                  $res=$dbh->query($sql);
                  while($row=$res->fetch(PDO::FETCH_ASSOC))
                  {
                    echo '<option value="'.$row['id'].'">'.$row['nom'].'</option>';
                  }
                }
                  catch(PDOException $e)
                  {
                  echo "Erreur de connexion : ".$e->getMessage()."<br />";
                  die();
                }
            ?>
          </select>
        </div>
         <div>
          <label>CV</label>
           <!-- On limite le fichier à 100Ko LOLs-->
          <input type="hidden" name="MAX_FILE_SIZE" value="10000000000000000">
          <input type="file" placeholder="CV" name="CV" id="">
          <?php
          if(isset($_FILES['CV']))
          {
            $dossier = 'upload/';
            $fichier = basename($_FILES['CV']['name']);
            $taille_maxi = 100000;
            $taille = filesize($_FILES['CV']['tmp_name']);
            $extensions = array('.png', '.jpg', '.jpeg');
            $extension = strrchr($_FILES['CV']['name'], '.'); 
            //Début des vérifications de sécurité...
            if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
            {
              $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg';
            }
            if($taille>$taille_maxi)
            {
              $erreur = 'Le fichier est trop gros mon ami...';
            }
            if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
            {
                 //On formate le nom du fichier ici...
                 $fichier = strtr($fichier, 
                      'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                      'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                 $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
                 if(move_uploaded_file($_FILES['CV']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                 {
                      echo 'Upload effectué avec succès cool!';
                 }
                 else //Sinon (la fonction renvoie FALSE).
                 {
                      echo 'Echec de l\'upload baad!';
                 }
            }
            else
            {
                 echo $erreur;
            }
          }
          ?>
        </div>
         <div>
          <label>Portofolio</label>
          <input type="text" placeholder="lien portofolio" name="portofolio" id="">
        </div>
         <div>
          <input type="reset" name="Supprimer" id="">
          <input type="submit" name="envoyer" id="">
        </div>
      </form>
    </div>   
  </body>
</html>