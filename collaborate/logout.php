<?php

include_once('header.php');

session_start();
session_unset();
session_destroy();

$_SESSION['authenticated'] = false;

header('Location: /');

?>