<div data-role="header">
		<h1><?php echo greet(); ?> </h1>
</div><!-- /header -->

<div data-role="content">	
		
<p><h2><?php echo DASH_RECENT; ?></h2></p>

		<?php

$events = mysql_query('select *,unix_timestamp(event_creationdate) as t from events,users where event_user_id = user_id order by event_creationdate desc limit 0,20');

while($e = mysql_fetch_assoc($events)) {
		
		if($e['event_text'] == "wrote a comment") {
			$e['event_text'] = "<a href='".BASE_URL."view-comment/".$e['event_relevant_id']."'>".$e['event_text']."</a>";
		}
	
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

		
</div><!-- /content -->

<?php ////////////////////////////////////////////////////// ?>



