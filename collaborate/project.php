<?php

function nope_chuck_testa() {
	?>
	<p>I bet you thought that was a real user ID.</p>
	<h1>NOPE!</h1>
	
	<?php
	
	return;
}

if(!isset($_REQUEST['q'])) nope_chuck_testa();
else {
	$u = mysql_query('select * from users where user_id = '.mysql_real_escape_string($_REQUEST['q']));	
	if(mysql_num_rows($u) == 0) nope_chuck_testa();  
	$u = mysql_fetch_assoc($u);
} 

?>

