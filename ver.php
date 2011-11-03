<?php
session_set_cookie_params(3000000);
session_start();
require('include/connect_db.php');


echo $_SESSION['identity_identity']; 

function failed() {
	echo "It didn't work! <br />Sorry!";	
}

$v = mysql_real_escape_string($_REQUEST['v']);

$f = mysql_query("select * from qrlogin_identities where identity_identity='$v' and !identity_activated") or die(mysql_error());

if(mysql_num_rows($f) == 0) return failed(); // The identity was invalidated!

// It looks legit, poke the comet stuff


$_SESSION['identity_identity'] = $_REQUEST['v'];

mysql_query("update qrlogin_identities set identity_activated=true where identity_identity='$v' limit 1");

?>

Your smartphone has been verified! 

