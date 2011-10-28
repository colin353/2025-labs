<h1><?php echo greet(); ?> </h1>

<p><h2><?php echo DASH_RECENT; ?></h2></p>

<?php

$events = mysql_query('select *,unix_timestamp(event_creationdate) as t from events,users where event_user_id = user_id order by event_creationdate desc limit 0,10');

while($e = mysql_fetch_assoc($events)) {
	?>
	
		<h3><?php echo getFirstName($e['user_realname']); ?><span class=sidenote><?php echo $e['event_text']; ?>
			
			<?php if($e['event_project_id'] != 0) {
				$p = mysql_fetch_assoc(mysql_query("select * from projects where project_id = ".$e['event_project_id']));
				echo "on <b>".$p['project_name'] . "</b> ";
			}
			
			echo "<span style='margin-left: 5px; color:grey'>".time_to_string(time()-$e['t'])."</span>"; 
			
			?>
			
		</span></h3>
	
	
	<?php	
}

?>
