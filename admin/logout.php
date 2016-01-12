<?php 
ob_start();
session_start();

// destruction fichiers session utilisateur
session_destroy();
unset($_SESSION);

// redirection vers l'index
header("Location: index.php");
