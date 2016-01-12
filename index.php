<?php 
	ob_start();
	include_once('_includes/functions.php');
	include_once( '_includes/init.php' );

	$email = trim(strip_tags($_POST['email']));
	$mailError = 'Adresse mail invalid';

	$errors = array();

	if(!empty($_POST)){

		$link = 'http://romaindubay.be/php/mailinglist/confirmation.php/?email='.$email;
		// $link = 'http://localhost:8888/php:mailinglist/confirmation.php/?email='.$email;

		if($_POST['messagespam'] != ''){

			die ("Tu n'es pas humain!");

		}else{

			if(empty($_POST['email'])){
				$errors['mail'] =  $mailError;
			}else if( isValidMail($email) == false ){
				$errors['mail'] = $mailError;
			}
		}

		if(empty($errors)){

			// $time =  date("Y-m-d h:i:s");
			$time =  time();
			$sql = 'INSERT INTO users(mail, role, time, valid)
			VALUES(:mail, :role, :time, :valid)';

			$preparedStatement = $connexion->prepare($sql);
			$preparedStatement->bindValue(':mail', $email);
			$preparedStatement->bindValue(':role', 'lecteur');
			$preparedStatement->bindValue(':time', $time);
			$preparedStatement->bindValue(':valid', '0');

			if($preparedStatement->execute()){
				require '_lib/php-mailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;

				$mail->isSMTP();
				$mail->Host = 'smtp.mandrillapp.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'alexandre@pixeline.be';
				$mail->Password = 'bDMUEuWn1H4r3FCGQjyO-g';
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;

				$mail->setFrom('test@example.com', 'Mailer');
				$mail->addAddress($email);

				$mail->isHTML(true);

				$mail->Subject = 'Inscription au produit';
				$mail->Body    = " Cliquer sur lien pour confirmer votre adresse mail: <br />".$link;
				$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				if(!$mail->send()) {
				    echo 'Message could not be sent.';
				    echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					header('Location: merci.php');
					exit;
				}
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
		<link rel="stylesheet" href="_css/main.css" media="all">
</head>
<body class="inscription">
	<form class="form--inscription" method="POST">

			<!-- <label for="mail" class="label">Adresse mail</label>  -->
			<input id="email" name="email" type="text" class="input" value="" placeholder="Adresse mail"/>
			<?php  echo message_errors($errors, 'mail'); ?>

			<!-- Honeypot -->
			<label for="messagespam" class="display">Si tu remplis, c'est que t'es pas humain!</label> 
			<input id="messagespam" class="display" name="messagespam" type="text" value=""/>

			<input type="submit" class="button" name="send" value="Inscription"/>
	<form>
</body>
</html>