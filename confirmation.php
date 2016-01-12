<?php
	include_once('_includes/functions.php');
	include_once('_includes/init.php');

$email = $_GET['email'];
$date = time();

$sql = 'SELECT * FROM users WHERE mail = :mail';
$preparedStatement = $connexion->prepare($sql);
$preparedStatement->bindValue(':mail', $email);
$preparedStatement->execute();
$user = $preparedStatement->fetch();

$inscrip_time = $user['time'];

$interval = $date-$inscrip_time;
$limit= 4800;

if($interval <= $limit){
	$query = "UPDATE users SET valid='1' WHERE mail = :mail";
	$preparedStatement = $connexion->prepare($query);
	$preparedStatement->bindValue(':mail', $email);
	$preparedStatement->execute();
	$user = $preparedStatement->fetch();
}
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
		<meta charset="UTF-8">
		<title>Mailinglist</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- <link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,900' rel='stylesheet' type='text/css' /> -->
		<link rel="stylesheet" href="_css/main.css" media="all">
</head>
<body class="confirm">
	<?php
	if($interval <= $limit){
		echo "<h1>Vous êtes bien inscrit</h1>";
	}else{
		echo "<h1>Trop tard, le délai de confiramation à expiré</h1>";
	}
	?>
</body>
</html>