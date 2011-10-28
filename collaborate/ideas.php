

<p>All ideas:<span class=sidenote><a href=<?php echo BASE_URL; ?>new-idea >+ add new idea</a> </span></p><br />

<?php
$is = mysql_query('select * from ideas where idea_approved = 0 order by idea_creationdate desc');
while($p = mysql_fetch_assoc($is)) {
	
// Get some votes
$q = $p['idea_id'];
$vs = mysql_query("select user_realname,(select vote_vote from votes where vote_user=user_id and vote_context='ideavote' and vote_owner=$q order by vote_creationdate desc limit 0,1) as user_vote from users") or die(mysql_error());
$ups = 0;
$downs = 0;
$first=true;
$userlist = '';
while($v = mysql_fetch_assoc($vs)) {
	if(is_null($v['user_vote'])) continue;
	else if($v['user_vote']) $ups++;
	else $downs++;
	
	if($first) $first=false; 
	else $userlist .= ", ";
	$userlist .=  getFirstName($v['user_realname']);
}	

if($userlist =='') {
	$userlist = "nobody yet!";
}

?>

	<div class="people-entry">
<h1><a href='idea/<?php echo $p['idea_id']; ?>' ><?php echo $p['idea_title']; ?></a><span class=sidenote>[ <span class=upvote><?php echo $ups; ?></span> | <span class=downvote><?php echo $downs; ?></span> ]</span></h1>	
	<p><b><?php echo COLLAB_PROJECTS_ENTRY1;?></b> <span><?php echo date('F jS Y',strtotime($p['idea_creationdate'])); ?> </span></p>
	

	<p><b><?php echo COLLAB_PROJECTS_ENTRY4;?></b> <?php echo $userlist; ?> <span> 
	
		</span></p>
	</div>
	
<?php

}

?>