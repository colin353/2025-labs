<?php

include_once('header.php');

session_destroy();

$_SESSION['authenticated'] = false;

header('Location: /');

?>