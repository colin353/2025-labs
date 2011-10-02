<?php

include_once('defaults.php');

function isAuthenticated() {
	if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == "true") return true;
	else return false;
} 

?>
