<?php

$link = mysql_connect('localhost','collaborate','collaborate');
if (!$link) {
	die('Could not connect to MySQL: ' . mysql_error());
}
mysql_close($link); 

?>