<?php
$q = mysql_real_escape_string($_REQUEST['q']);
$p = mysql_query('select * from ideas where idea_id = '.$q);	
	if(mysql_num_rows($p) == 0) nope_chuck_testa();  
	$p = mysql_fetch_assoc($p);

$up_chequed = $down_chequed = '';
$u = $_SESSION['user_id'];
$votes = mysql_query("select * from votes where vote_user = $u and vote_context = 'ideavote' and vote_owner = $q order by vote_creationdate desc") or die(mysql_error());

if($vote = mysql_fetch_assoc($votes)) {
	if($vote['vote_vote']) $up_chequed = "checked";
	else $down_chequed = "checked";	
}

?>

<script>
	function showQform() {
		$('#comment_type').show('fast');		
	}
</script>

<h1><?php echo $p['idea_title']; ?><span class=sidenote><a onClick=showQform() href=#>+ add new question</a></span></h1>
<p><?php echo $p['idea_description']; ?> </p> <br />


<p>Do you think this is a good idea?</p>
<form method=post>
	<input <?php echo $up_chequed; ?> id=upboatyes type=radio name=upboat value=yes />Yes<br />
	<input <?php echo $down_chequed; ?> type=radio name=upboat value=no />No<br />
</form> <br /><br />
<script>
$('input[type="radio"]').change( function() {
		if($('#upboatyes').is(':checked')) idea_vote(1,<?php echo $q; ?>);
		else idea_vote(0,<?php echo $q; ?>);		
});
</script>



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

<br />
<div id=comment_type class=hiding>
<form action=action.php id=comment_form class=inputForm method=post>
	<h2>Start a new discussion:</h2><br /><br />
	<textarea placeholder="Write your question here..." name=comment_text></textarea>
	<br />
	<input type=hidden id=reply_to name=reply_to value=<?php echo $q;?> />
	<input type=hidden name=create_comment value=true />
	<input type=hidden name=comment_context value=ideaquestion />
	<input type=hidden name=comment_unique value=<?php echo rand().rand(); ?> />
	<input type=button onclick="return post_comment()&&false;" value=Reply />
</form></div>
