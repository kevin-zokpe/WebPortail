<?php
session_start();
  	$_SESSION['nom']= isset($_POST['nom'])?$_POST['nom']:"";
    $_SESSION['login']= isset($_POST['login'])?$_POST['login']:"";
    $_SESSION['mdp']= isset($_POST['mdp'])?$_POST['mdp']:"";
    $_SESSION['pays']= isset($_POST['pays'])?$_POST['pays']:"";
    $_SESSION['ville']= isset($_POST['ville'])?$_POST['ville']:"";
    $_SESSION['desc']= isset($_POST['desc'])?$_POST['desc']:"";  
    $_SESSION['website']= isset($_POST['website'])?$_POST['website']:"";

  	if($_SESSION['nom']!="" && $_SESSION['login'] && $_SESSION['mdp'])
  	{
  		require('connexion.php');
  		try
  		{
  			$sql="insert into entreprise values (NULL,
  												'" . $_SESSION['nom'] . "','" . $_SESSION['login'] . "','" . $_SESSION['mdp']. "','".$_SESSION['pays']."','".$_SESSION['ville']. "','".$_SESSION['desc']."','".$_SESSION['website']."')";
  			$dbh->query($sql);
  			session_unset();
  			$_SESSION['login']=$_POST['login'];
  			$_SESSION['mdp']=$_POST['mdp'];
  			header("location: consultation-Entreprise.php");
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
  		header("location: Form-Inscription-Entreprise.php");
  	}
?>


