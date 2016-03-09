<?php
	session_start();
	require("connexion.php");
	try
	{
	$sql="delete from etudiant where id=".$_SESSION['id'];
	$dbh->query($sql);

	session_destroy();
	session_unset();
	}
	catch(PDOException $e){
		echo "Erreur de connexion : ".$e->getMessage()."<br />";
		die();
	}
	header("location: Form-Connexion.php");
?>