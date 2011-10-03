<?php 

include('../include/init.php');

$user_name = mysql_real_escape_string($_POST['username']);
$user_pass = mysql_real_escape_string(MD5(DEFAULT_SALT.$_POST['password']));
$user = mysql_query("select * from users where user_name = '$user_name' and user_pass = '$user_pass'") or die(mysql_error());

if(mysql_num_rows($user) == 1) {
	$_SESSION['authenticated'] = "true";
	$u = mysql_fetch_assoc($user);
	foreach($u as $k => $v) $_SESSION[$k] = $v;
	
}
else {
	header('Location: logout.php');
}


if(isset($_SERVER['HTTP_REFERER'])) 
	header('Location: '.$_SERVER['HTTP_REFERER']);
else 
	header('Location: /')
	
?>