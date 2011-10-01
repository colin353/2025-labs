<?php

function isAuthenticated() {
	
	if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']) return true;
	else return false;
	
} 

?>
