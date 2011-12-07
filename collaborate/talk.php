+<?php 
$cs = mysql_query("SELECT *, unix_timestamp(a.comment_creationdate) as t,(select comment_creationdate from comments where comment_op = a.comment_id order by comment_creationdate desc limit 0,1) as t_child FROM `comments` as a, users where comment_owner = user_id and comment_context = 'ideaquestion'  order by (t_child is null) asc, t_child desc limit 20");
while($c = mysql_fetch_assoc($cs)) {

?>

	<div class=comment_level>
	<div onClick="goto('<?php echo BASE_URL."view-comment/".$c['comment_id']; ?>')" style="border-left: 5px solid #<?php echo $c['user_colour']; ?>" class=comment>
		<p><?php echo str_replace("\n","<br />",$c['comment_text']); ?></p>
		
		<p style="color: grey;">posted by <?php echo $c['user_realname'].', '.time_to_string(time()-$c['t']).''; ?></p>	
	</div></div>
<?php
	
}
