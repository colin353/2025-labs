<?php 

include('../include/init.php');
$qr = false;
if(isset($_REQUEST['a'])) {
	// QR code login attempt
	$qr=true;
	$a = mysql_real_escape_string($_REQUEST['a']);
	
	$b = mysql_real_escape_string($_REQUEST['b']);
	$qrattempt = mysql_query("select * from qrlogin_identities, users, qrlogin_sessions where user_id=identity_user and identity_id = session_identity and session_token='$b' and session_qrlink='$a'") or die(mysql_error());

if(mysql_num_rows($qrattempt) > 0) {
	$u = mysql_fetch_assoc($qrattempt);
	$user_name = $u['user_name'];
	$user_pass = $u['user_pass'];	
}

} else { 
	$user_name = mysql_real_escape_string($_POST['username']);
	$user_pass = mysql_real_escape_string(MD5(DEFAULT_SALT.$_POST['password']));
}
$user = mysql_query("select * from users where user_name = '$user_name' and user_pass = '$user_pass'") or die(mysql_error());

if(mysql_num_rows($user) == 1) {
	$_SESSION['authenticated'] = "true";
	$_SESSION['time'] = time();
	$u = mysql_fetch_assoc($user);
	foreach($u as $k => $v) $_SESSION[$k] = $v;
	
	if(!$qr) eventLog("logged in",$u['user_id']);
	else eventLog("logged in via phone authorization",$u['user_id']);
}
else {
	header('Location: logout.php');
}


if(isset($_REQUEST['direct'])) 
	header('Location: '.$_REQUEST['direct']);
else 
	header('Location: /');
	
?>