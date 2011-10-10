<?php

include_once('include/auth_head.php');


eventLog("logged out");

session_start();
session_unset();
session_destroy();

$_SESSION['authenticated'] = false;



header('Location: /');

?>