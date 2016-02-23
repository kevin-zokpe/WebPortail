<?php
session_start();
  	$_SESSION['nom']= isset($_POST['nom'])?$_POST['nom']:"";
  	$_SESSION['prenom']= isset($_POST['prenom'])?$_POST['prenom']:"";
    $_SESSION['pays']= isset($_POST['pays'])?$_POST['pays']:"";
    $_SESSION['domaine']= isset($_POST['domaine'])?$_POST['domaine']:"";

  	// $_SESSION['ville']= isset($_POST['ville'])?$_POST['ville']:"";
  	// $_SESSION['pays']= isset($_POST['pays'])?$_POST['pays']:"";

  	$_SESSION['login']= isset($_POST['login'])?$_POST['login']:"";
  	$_SESSION['mdp']= isset($_POST['mdp'])?$_POST['mdp']:"";
    $_SESSION['cv']= isset($_POST['cv'])?$_POST['cv']:"";
    $_SESSION['portofolio']= isset($_POST['portofolio'])?$_POST['portofolio']:"";

  	if($_SESSION['nom']!="" && $_SESSION['login'] && $_SESSION['mdp'])
  	{
  		require('connexion.php');
  		try
  		{
  			$sql="insert into etudiant values (NULL,
  												'" . $_SESSION['nom'] . "','" . $_SESSION['prenom'] . "','" . $_SESSION['pays']. "','".$_SESSION['domaine']."','".$_SESSION['login']. "','".$_SESSION['mdp']."','".$_SESSION['cv']."','".$_SESSION['portofolio']."')";
  			$dbh->query($sql);
  			session_unset();
  			$_SESSION['login']=$_POST['login'];
  			$_SESSION['mdp']=$_POST['mdp'];
  			header("location: Consultation-Etudiant.php");
  		}
  		catch(PDOException $e)
  		{
			echo "Erreur de connexion : ".$e->getMessage()."<br />";
			die();
		}
  	}
  	else
  	{
  		$_SESSION['erreur']="Champs Manquants";
  		header("location: inscription.php");
  	}
?>


