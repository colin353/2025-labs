<?php

if(isset($_REQUEST['q'])) {
		
}

$users = mysql_query('select * from users order by rand() limit 0,10');
?>

<p><?php echo COLLAB_PEOPLE_SEARCH1; ?></p><br />

<?php 

while($u = mysql_fetch_assoc($users)) {
	?>
	
	<div class="people-entry">
	
		<h1><a href='person/<?php echo $u['user_id']; ?>' ><?php echo $u['user_realname']; ?></a><div style="background-color: #<?php echo $u['user_colour']; ?> " class=colourbox> </div> <span class=sidenote>(aka <?php echo $u['user_name']; ?>)</span></h1>	
		<p><b><?php echo COLLAB_PEOPLE_ENTRY1;?></b> <span><?php echo date('F jS Y',strtotime($u['user_creationdate'])); ?> </span></p>
		<p><b><?php echo COLLAB_PEOPLE_ENTRY2;?></b> <span> <?php echo format_dollars(myBalance($u['user_id'])); ?>  </span></p>
		
	</div>
	
	<?php	
}

?>

