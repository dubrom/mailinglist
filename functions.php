<?php
	function isValidMail($argument){
		return filter_var($argument, FILTER_VALIDATE_EMAIL);
	};

	function message_errors($errors, $clef){
		if(count($_POST)>0 && $errors[$clef] != ''){
			return "<p class='erreur'>".$errors[$clef]."</p>";
		}
	};
	function redirectTo($url){
		header('Location: '.$url);
		exit;
	};

	// function getConnectedUser($connexion){
	// 	if(empty($_SESSION['user_secret'])){
	// 	  	return false;
	// 	}
	// 	$secret = $_SESSION['user_secret'];
	// 	$query = $connexion->prepare('SELECT * FROM user WHERE secret = :secret');
	// 	$query->bindValue(':secret', $secret);
	// 	$query->execute();
	// 	if($user = $query->fetch()){
	// 	  	return $user;
	// 	}else{
	// 	  return false;
	// 	}
	// }