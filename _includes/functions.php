<?php
	function isValidMail($argument){
		return filter_var($argument, FILTER_VALIDATE_EMAIL);
	};

	function message_errors($errors, $clef){
		if(count($_POST)>0 && $errors[$clef] != ''){
			return "<p class='erreur'>".$errors[$clef]."</p>";
		}
	};