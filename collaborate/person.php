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

<h1><?php echo $u['user_realname']?><span class=sidenote>(aka <?php echo $u['user_name']; ?>)</span></h1>
<p><b><?php echo COLLAB_PERSON_ENTRY1;?></b> <span><?php echo date('F jS Y',strtotime($u['user_creationdate'])); ?> </span></p>
<p><b><?php echo COLLAB_PERSON_ENTRY2;?></b> <span> $100 </span></p>
<br />
<h1><?php echo getFirstName($u['user_realname']); ?>'s projects:</h1>
(here goes a list of projects this person is part of)
