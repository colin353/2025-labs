<?php


$u = create_qridentity();

?>

<h1>Verify your smartphone</h1>

<p>Use your smartphone to read this QR code link. Be sure nobody is watching behind you! The next phone that uses this code will be authenticated to you!</p>

<img src=/qr.php?verif=true&q=<?php echo $u; ?> />
