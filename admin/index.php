<?php 
	ob_start();
	define('login', 'miaow');
	
	include_once('../_includes/functions.php');
	include_once('../_includes/init.php');


	// if($user = getConnectedUser($connexion)){
	// 	header('Location: index.php');
	// 	exit;
	// }

	$errors = array();
	if(!empty($_POST)){
		$mail = trim(strip_tags($_POST['mail']));
		$mdp = trim(strip_tags($_POST['mdp']));

		if($_POST['messagespam'] != ''){

			die ("Tu n'es pas humain!");

		}else{
			if(empty($_POST['mail'])){
				$errors['mail'] = 'Email incorrect';
			}

			if(empty($_POST['mdp'])){
				$errors['mdp'] = 'Mot de passe incorrect';
			}
		}
		

		if(empty($errors)){
			$sql = 'SELECT * FROM users WHERE mail = :mail';
			$preparedStatement = $connexion->prepare($sql);
			$preparedStatement->bindValue(':mail', $mail);
			$preparedStatement->execute();
			$user = $preparedStatement->fetch();

			if(!empty($user) && $user['role'] == 'admin' && $user['mdp'] == $mdp){
		    	$_SESSION['logged_in'] = 'ok';
		    	$_SESSION['email'] = $email;
		    } else {
		        $errors['login'] = "Mauvaise combinaison, essaye à nouveau !";
		    }
		}
	}
?>

<!doctype html>
<html class="no-js" lang="fr">
<head>
		<meta charset="UTF-8">
		<title>Mailinglist</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,900' rel='stylesheet' type='text/css' /> -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" /> -->
		<link rel="stylesheet" href="../_css/main.css" media="all">
</head>
<body class="inscription">
	<?php 
		if($_SESSION['logged_in'] == 'ok'){
			include 'manage.php';
		}else { 
			include 'form.php';
		}
	 ?>
</body>
</html>