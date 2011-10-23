<?php

$p = mysql_query('select * from ideas where idea_id = '.mysql_real_escape_string($_REQUEST['q']));	
	if(mysql_num_rows($p) == 0) nope_chuck_testa();  
	$p = mysql_fetch_assoc($p);

?>

<h1><?php echo $p['idea_title']; ?><span class=sidenote><a href=#>+ add new question</a></span></h1>
<p><?php echo $p['idea_description']; ?> </p> <br />

<h2>Feedback</h2><br />
<p>Do you think this is a good idea?</p>
<form method=post>
	<input type=radio name=upboat value=yes />Yes<br />
	<input type=radio name=upboat value=no />No<br />
</form> <br /><br />

<h2>Discussion</h2>

<div class=comment>
	<h3>What about X, Y, or Z?</h3>
	<p>posted by </p>	
</div>
<div class=comment>
	<h3>But how about this or that?</h3>
	<p>posted by </p>
	
</div>