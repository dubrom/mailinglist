<?php
	ob_start();
	session_start();
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);
	//infos pr onnexion a la base de données 
	$host = 'localhost';
	$dbname = 'mailinglist';
	$user = 'root';
	$password = 'root';
	
	// $host = 'localhost';
	// $dbname = 'mailinglist';
	// $user = 'romaindubay';
	// $password = '9WLtP3AsJUo0P9mR';
	
	try{
	    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
		//Connexion a la base de données 
	    $connexion = new PDO($dsn, $user, $password);
    }catch(PDOException $e){
    	echo $e->getMessage();
    	exit;
    }

