<?php

$projects = mysql_query('select * from projects limit 0,10')


?>


<p><?php echo COLLAB_PROJECTS_SEARCH; ?><span class=sidenote><a href=<?php echo BASE_URL; ?>new-project >+ add new project</a> </span></p><br />

<?php

while($p = mysql_fetch_assoc($projects)) {
	
	?>
	
	<div class="people-entry">
	
	<h1><a href='project/<?php echo $p['project_id']; ?>' ><?php echo $p['project_name']; ?> </a></h1>	
	<p><b><?php echo COLLAB_PROJECTS_ENTRY1;?></b> <span><?php echo date('F jS Y',strtotime($p['project_creationdate'])); ?> </span></p>
	<p><b><?php echo COLLAB_PROJECTS_ENTRY2;?></b> <span> <?php echo format_dollars(projBalance($p['project_id'])); ?> </span></p>
	<p><b><?php echo COLLAB_PROJECTS_ENTRY3;?></b> <span> <?php echo $p['project_description']; ?> </span></p>	
	<p><b><?php echo COLLAB_PROJECTS_ENTRY4;?></b> <span> 
		
		<?php
		
			$mems = mysql_query('select * from users, projectmemberships where projectmembership_user_id = user_id and projectmembership_project_id = ' . $p['project_id'] . ' limit 0,5') or die(mysql_error());
			$first=true;
			while($mem = mysql_fetch_assoc($mems)) {
				if($first) $first = false;
				else echo ",";
				?>
				
				<?php echo getFirstName($mem['user_realname']); ?>
				
				<?php				
			}
		
		?>
		
		</span></p>
	</div>
	
	
	
	<?php	
}

?>