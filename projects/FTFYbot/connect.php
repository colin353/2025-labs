<?php

$con = mysql_connect("localhost","ftfybot","");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('ftfybot',$con) or die(mysql_error());

?>