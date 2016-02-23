<?php
session_start();
 // on verifie si le login existe dans la session
 if (!isset($_SESSION['login']))
 	die("Access Denied");
 if (!isset($_SESSION['nom']))
 require('connexion.php');
 try
		{
			$sql='select * from etudiant where mail="'.$_SESSION['login'].'"';
			$res=$dbh->query($sql);
			$l=$res->fetch();
			$_SESSION['id']=$l[0];
			$_SESSION['prenom']=$l[1];
			$_SESSION['pays']=$l[2];
			$_SESSION['photo']=$l[3];
			$_SESSION['cv']=$l[4];
			$_SESSION['portofolio']=$l[5];
		}
	//NB: prévoir d'afficher des messages d'erreur pour vous aider à avancer!
		catch(PDOException $e){
		echo "Erreur de connexion : ".$e->getMessage()."<br />";
		die();
		}
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
	<title> Consultation</title>
</head>
<body>
<h1> Bonjour <?php
echo $_SESSION['photo'];
echo $_SESSION['prenom'];
?>
</h1>
<span><a href="deconnexion.php"> Vous deconnecter ?</a></span><br/>
<span><a href="desinscription.php"> Vous désisncrire ?</a></span>
</body>
</html>