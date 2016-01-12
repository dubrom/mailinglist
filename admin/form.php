<?php 
if(!defined('login')){
		die('No access for you!');
	}
?>
<form class="form--connexion" method="POST">

			<!-- <label for="mail" class="label">Adresse mail</label>  -->
			<input id="mail" name="mail" type="text" class="input" value="" placeholder="Adresse mail"/>
			<?php  //echo message_errors($errors, 'mail'); ?>

			<input id="mdp" name="mdp" type="text" class="input" value="" placeholder="Mot de passe"/>

			<!-- Honeypot -->
			<label for="messagespam" class="display">Si tu remplis, c'est que t'es pas humain!</label> 
			<input id="messagespam" class="display" name="messagespam" type="text" value=""/>

			<input type="submit" class="button" name="send" value="Connexion"/>
	<form>