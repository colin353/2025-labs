<?php
require('include/connect_db.php');

session_start();

function failed($debug) {
	echo "It didn't work! <br />Sorry!<br />".$debug;	
}


$v = mysql_real_escape_string($_REQUEST['v']);
$verif = mysql_query("select * from qrlogin_sessions where session_qrlink = '$v' and session_identity=0");

if(mysql_num_rows($verif) != 1) return failed('The link was messed yo'); // Their link was messed yo 

$verif = mysql_fetch_assoc($verif);
$token = $verif['session_token'];

if(!isset($_SESSION['identity_identity'])) return failed('Unverified smartphone'); // They used a random smartphone!

$f = mysql_query("select * from qrlogin_identities where identity_identity='".$_SESSION['identity_identity']."'");

if(mysql_num_rows($f) != 1) return failed('invalid identity'); // The identity was invalidated!

$f = mysql_fetch_assoc($f);

// It looks legit, poke the comet stuff

mysql_query("update qrlogin_sessions set session_identity = ".$f['identity_id']." where session_id=".$verif['session_id']);

$fp = fsockopen("127.0.0.1", $verif['session_port'], $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $out = $_REQUEST['v']." ".$token;
    fwrite($fp, $out);
    while (!feof($fp)) {
        echo fgets($fp, 128);
    }
    fclose($fp);
}


?>
It worked!