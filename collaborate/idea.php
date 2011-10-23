<?php
$q = mysql_real_escape_string($_REQUEST['q']);
$p = mysql_query('select * from ideas where idea_id = '.$q);	
	if(mysql_num_rows($p) == 0) nope_chuck_testa();  
	$p = mysql_fetch_assoc($p);

?>

<h1><?php echo $p['idea_title']; ?><span class=sidenote><a href=#>+ add new question</a></span></h1>
<p><?php echo $p['idea_description']; ?> </p> <br />


<p>Do you think this is a good idea?</p>
<form method=post>
	<input type=radio name=upboat value=yes />Yes<br />
	<input type=radio name=upboat value=no />No<br />
</form> <br /><br />

<h2>Discussion</h2>

<?php 

$d = mysql_query("select * from comments,users where comment_owner = user_id and comment_context = 'ideaquestion' and comment_replyto = $q and comment_deleted=0") or die(mysql_error());
if(mysql_num_rows($d) == 0) echo "<p>No discussion yet...</p>";
else while($c = mysql_fetch_assoc($d)) {
?>

<div onClick="goto('<?php echo BASE_URL."view-comment/".$c['comment_id']; ?>')" class=comment>
	<h3><?php echo $c['comment_text']; ?></h3>
	<p>posted by <?php echo $c['user_realname']; ?></p>	
</div>

<?php } ?>
