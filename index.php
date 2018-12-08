<?php
	// pour garder la session (doit etre au debut de  la'pplication)
	session_start();
	// etablir la conn avec la bdd
	try{
	// $bdd est accessible par tous les fichier appelé par index.php
		$bdd = new PDO('mysql:host=127.0.0.1;dbname=pfe','root', '');
	}
	catch (Exception $e) { die('Erreur : '.$e->getMessage()); } // stopper l'application si la bdd echoue
	$page = $_GET['page'];  // optenir apartir des parametres la variable 'page' ===> url?page=first
	include './'.$page.'.php';
?>