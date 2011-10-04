<div id=content>

<h1>Collaborate: to do list<span class=sidenote> <a onclick="$('#newmilestoneform').show('fast')">+ add new milestone</a></span></h1><br />


<div id=newmilestoneform class=hiding><form onSubmit="return newMilestoneSubmit();">
	<span>Milestone name:</span><input class=todolistforms type=text id=newmilestone placeholder="" />
</form>
</div>
<br />

<?php

$miles = mysql_query('select * from todolistmilestone where todolistmilestone_project_id = '.mysql_real_escape_string($_REQUEST['q']).' order by todolistmilestone_order');

while($m = mysql_fetch_assoc($miles)) {

?>

<div class=milestone>
	<span>Milestone: <b><?php echo $m['todolistmilestone_name']; ?></b> <span class=sidenote><a onClick="$('#newtaskform<?php echo $m['todolistmilestone_id'];?>').show('fast')">+ add new task</a></span></span>	
	<div id=newtaskform<?php echo $m['todolistmilestone_id'];?> class=hiding>
		<input type=checkbox /> 
		<select id=select<?php echo $m['todolistmilestone_id'];?>>
			<option value=0 >somebody</option>
			<?php {
				$people = mysql_query('select * from users,projectmemberships where user_id = projectmembership_user_id and projectmembership_project_id = '.mysql_real_escape_string($_REQUEST['q']));
				while($p = mysql_fetch_assoc($people)) echo "<option value=".$p['user_id'].">".$p['user_name']."</option>";	
			}
			?>
		</select>
		<span>should <form onSubmit="return newTaskSubmit(<?php echo $m['todolistmilestone_id']; ?>);"><input class=todolistforms placeholder="do a particular task..." type=text id=todo_entry<?php echo $m['todolistmilestone_id'];?> /><input type="submit" value="Submit the form!" style="position: absolute; top: 0; left: 0; z-index: 0; width: 1px; height: 1px; visibility: hidden;" />	</form>
	</b></span>
	</div>
	<?php 
		$tos = mysql_query('select * from todolist where todolist_milestone_id = '.$m['todolistmilestone_id']); 
		while($t = mysql_fetch_assoc($tos)) {
		if($t['todolist_user_id'] == 0) $tusername = "somebody";
		else {
			$tusername = mysql_fetch_assoc(mysql_query('select * from users where user_id = '.$t['todolist_user_id']));
			$tusername = $tusername['user_name'];
		}
	?>
	<div>
		<input type=checkbox /> 
		<span><b><?php echo $tusername; ?></b></span><span>should</span><span class=todoitem><?php echo $t['todolist_text']; ?></span>
	</div>
	<?php } ?>
</div>
<?php } ?>

</div>