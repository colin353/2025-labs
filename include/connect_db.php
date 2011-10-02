<?php

$link = mysql_connect('localhost','collaborate','collaborate');
mysql_select_db('collaborate',$link) or die(mysql_error());
if (!$link) {
	die('Could not connect to MySQL: ' . mysql_error());
}


?>