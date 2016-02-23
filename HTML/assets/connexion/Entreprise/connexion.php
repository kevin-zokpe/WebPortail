<?php
	$user='root';
	$pass='reseaux';
	$dbn='mysql:host=localhost;dbname=webjuice';
	try{
		$dbh=new PDO($dbn,$user,$pass);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo "Erreur de connexion".$e->getMessage().'<br />';
		die();
	}
?>