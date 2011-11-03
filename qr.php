<?php

require('include/phpqrcode.php');

if(isset($_REQUEST['verif'])) QRcode::png('http://2025-labs.com/ver.php?v='.$_REQUEST['q'],false,10,5);
else QRcode::png('http://2025-labs.com/v.php?v='.$_REQUEST['q'],false,10,5);

?>
