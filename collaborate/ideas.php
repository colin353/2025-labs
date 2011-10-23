

<p>All ideas:<span class=sidenote><a href=<?php echo BASE_URL; ?>new-idea >+ add new idea</a> </span></p><br />

<?php
$is = mysql_query('select * from ideas where idea_approved = 0 order by rand()');
while($p = mysql_fetch_assoc($is)) {
?>

	<div class="people-entry">
<h1><a href='idea/<?php echo $p['idea_id']; ?>' ><?php echo $p['idea_title']; ?></a><span class=sidenote>[ <span class=upvote>4</span> | <span class=downvote>3 </span> ]</span></h1>	
	<p><b><?php echo COLLAB_PROJECTS_ENTRY1;?></b> <span><?php echo date('F jS Y',strtotime($p['idea_creationdate'])); ?> </span></p>
	

	<p><b><?php echo COLLAB_PROJECTS_ENTRY4;?></b> nobody yet! <span> 
	
		</span></p>
	</div>
	
<?php

}

?>