<?php

session_start();
include('functions.php');
foreach (glob("copy/*.php") as $filename) include $filename;

if(isAuthenticated()) include('../include/connect_db.php');

?>