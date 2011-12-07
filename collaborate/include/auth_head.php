<?php

@include_once('../include/init.php');


if(!isAuthenticated()) {
	$_SESSION['deauthenticated'] = true;
	$_SESSION['ref'] = $_SERVER['REQUEST_URI'];
	return header('Location: /');
} 

?>