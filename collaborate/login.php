<?php 

include('../header.php');

$_SESSION['authenticated'] = true;

if(isset($_SERVER['HTTP_REFERER'])) 
	header('Location: '.$_SERVER['HTTP_REFERER']);
else 
	header('Location: /')
	
?>