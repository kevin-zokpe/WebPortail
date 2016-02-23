<?php
	session_start();
	if (isset($_POST['login']) && $_POST['login']!="") 
	{//On vérifie s'il y a bien un login 
		include("connexion.php");
	//On inclut le script de connection à la base
	//et c'est ici que démarre votre travail:
	// récupérer login et mdp issus de POST
		try
		{
			$login=$_POST['login'];
			$mdp=(isset($_POST['mdp'])?$_POST['mdp']:''); // on utilise l'opértateur ternaire
			
			/* if (isset($_POST['mdp']) && $_POST['mdp']!=""){
			$mdp=$_POST['mdp']; ------> équivalent de l'opérateur ternaire */
			$sql='select count(*) from etudiant where mail="'.$login.'"and mdp="'.$mdp.'"';
			$res=$dbh->query($sql);
			//vérifier que l'utilisateur existe dans la base (il faut donc l'avoir créé!)
			//S'il existe:
			// on part vers consultation.php (header("location: consultation.php");)
			if($res->fetchColumn()>0)
			{
				$_SESSION['login']=$login;
				header("location: Consultation-Etudiant.php");
			}
			//Sinon:
	    	// on part vers inscription.php
			else
			{
				header("location: Form-Inscription-Etudiant.php");
			}
		}
	//NB: prévoir d'afficher des messages d'erreur pour vous aider à avancer!
		catch(PDOException $e){
		echo "Erreur de connexion : ".$e->getMessage()."<br />";
		die();
		}
	}
	else
	{
		header("location: accueil.php");
	}
?>
