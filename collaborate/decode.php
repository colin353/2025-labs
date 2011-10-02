<?php

function display_page($page) {
	include('include/header.php');
	if(file_exists($page.".php")) include($page.".php");
	else include("404.php");
	include('include/footer.php');
	
	return;	
}

// Is the person looking to login/out? If yes, then let them.

if($_SERVER['REQUEST_URI'] == "/collaborate/login.php") return include('login.php');
if($_SERVER['REQUEST_URI'] == "/collaborate/logout.php") return include('logout.php');

// If the person is not looking to log in, make sure they are already logged in.

include('include/auth_head.php');

// Did the person specify a PHP file? If not, redirect to index

if($_SERVER['REQUEST_URI'] == '/collaborate/') return display_page('index');

// Did the person specify a PHP file but with no arguments? If yes, then return include it

if(preg_match('~^/collaborate/([a-z\-]+)/*$~',$_SERVER['REQUEST_URI'],$m)) return display_page($m[1]);

// Did the person specify a PHP file and has a numerical argument? If yes, return include it

if(preg_match('~^/collaborate/([a-z\-]+)/([0-9]+)/*$~',$_SERVER['REQUEST_URI'],$m)) {
	$_REQUEST['q'] = $m[2];
	return display_page($m[1]);
}

// Looks like you are lost, send you to 404.php

return display_page("404");

?>