<script>
	function makeComment(id) {
		$("#reply_to").val(id);
		$("#comment_type").show('fast');		
	}	
</script>

<?php 
$q = mysql_real_escape_string($_REQUEST['q']);
$c = myQuery("select *,(unix_timestamp(comment_creationdate)) as t from users,comments where user_id = comment_owner and comment_id = $q") or die(mysql_error());

function displayCommentThread($c,$l=0) {
	if($l > 10) return;
?>
	<div class=comment_level>
	<div class=comment>
		<p><?php echo $c['comment_text']; ?></p>
		<a onClick="makeComment(<?php echo $c['comment_id']; ?>)" style="float: right; margin-right: 20px;" href=#>reply</a><p style="color: grey;">posted by <?php echo $c['user_realname'].', '.time_to_string(time()-$c['t']).''; ?></p>	
	</div>
<?php
	
	$cs = mysql_query("select *,(unix_timestamp(comment_creationdate)) as t from comments,users where comment_context = 'inherit' and  user_id = comment_owner and comment_replyto =".$c['comment_id']);
	while($c = mysql_fetch_assoc($cs)) displayCommentThread($c,$l+1);
	echo "</div>";
}

displayCommentThread($c);

?>
<br />
<div id=comment_type class=hiding>
<form  action=action.php id=comment_form class=inputForm method=post>
	<p>Write a comment:</p>
	<textarea placeholder="Write your comment here..." name=comment_text></textarea>
	<br />
	<input type=hidden id=reply_to name=reply_to value=fail />
	<input type=hidden name=create_comment value=true />
	<input type=hidden name=comment_unique value=<?php echo rand().rand(); ?> />
	<input type=button onclick="return post_comment()&&false;" value=Reply />
</form></div>
