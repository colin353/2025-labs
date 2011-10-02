<?php

session_start();

include('connect_db.php');
include('functions.php');
foreach (glob("copy/*.php") as $filename) include $filename;


?>