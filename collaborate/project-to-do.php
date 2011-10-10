

<?php

$pstat = getProjectState($_REQUEST['q']);

$header_sidenote = "<a onclick=\"$('#newmilestoneform').show('fast')\">+ add new milestone</a>"; 
include('include/header-project.php'); ?>
<br />
<div id=newmilestoneform class=hiding><form onSubmit="return newMilestoneSubmit();">
	<span>Milestone name:</span><input class=todolistforms type=text id=newmilestone placeholder="" />
</form>
</div>
<br />

<?php

$miles = mysql_query('select * from todolistmilestone where todolistmilestone_project_id = '.mysql_real_escape_string($_REQUEST['q']).' order by todolistmilestone_order');
$q =0;$q2=0;$script = ""; 
while($m = mysql_fetch_assoc($miles)) { ?>

<div id=sortable> 
<div id=milestone_<?php echo $m['todolistmilestone_id']; ?> class="milestone<?php if($pstat['next_id'] == $m['todolistmilestone_id']) echo ' milestone_current'; ?>" >
	
	<?php $script .= "me[".$q2++."] = ". $m['todolistmilestone_id'].";\n"; ?>
	
	
	<span>Milestone: <b><?php echo $m['todolistmilestone_name']; ?></b> <span class=sidenote><a onClick="$('#newtaskform<?php echo $m['todolistmilestone_id'];?>').show('fast')">+ add new task</a></span></span>	<span class="hiding milekiller"><a href=# onClick="if(confirm('Are you for real?')) delete_milestone(<?php echo $m['todolistmilestone_id']; ?>)" >delete</a></span>
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
		$tos = mysql_query('select * from todolist where todolist_milestone_id = '.$m['todolistmilestone_id'].' order by todolist_status,todolist_created'); 
		
		while($t = mysql_fetch_assoc($tos)) {
		if($t['todolist_user_id'] == 0) $tusername = "somebody";
		else {
			$tusername = mysql_fetch_assoc(mysql_query('select * from users where user_id = '.$t['todolist_user_id']));
			$tusername = $tusername['user_name'];
		}
	?>
	<div <?php if($t['todolist_status'] == 1) echo "class=strike "; ?>id=task<?php echo $t['todolist_id']; ?>>
		<input <?php if($t['todolist_status'] == 1) echo "checked"; ?> onchange=chTask(<?php echo $t['todolist_id']; ?>) id=check<?php echo $t['todolist_id']; ?> type=checkbox /> 
		<span><b><?php echo $tusername; ?></b></span><span>should</span><span class=todoitem><?php echo $t['todolist_text']; ?></span>
		<span class="killer_queen hiding"><a onClick='task_delete(<?php echo  $t['todolist_id']; ?>)' href=#>delete</a></span>
	
	</div>
	
	<?php 
		$script .=	"le[".$q++."] = " . $t['todolist_id'].";\n";
	}
	?>
</div>
<?php } ?>
</div>

<script>
		le = Array(<?php echo $q; ?>);
		me = Array(<?php echo mysql_num_rows($miles);?>);
		<?php echo $script; ?>
		
		
		function dblClickMilestoneEvent(event) {
				if(event.target.tagName == "DIV") {
					$(event.target).children('.milekiller').toggle('fast');
				} 	
		}
		
		for(i=0;i<<?php echo $q2; ?>;i++) {
			$("#milestone_"+me[i]).bind('dblclick',dblClickMilestoneEvent);			
		}
		
		function dblClickTaskEvent(event) {
				if(event.target.tagName == "DIV")  $(event.target).children('.killer_queen').toggle('fast');
				else if(event.target.tagName == "B") $(event.target).parent().siblings('.killer_queen').toggle('fast');
				else $(event.target).siblings('.killer_queen').toggle('fast');
		}
		
		for(i=0;i<<?php echo $q; ?>;i++) {
			$("#task"+le[i]).bind('dblclick',dblClickTaskEvent);			
		}

		$('#sortable').sortable(
				{distance: 100, update: function(action,ui) {
				$.get(BASE_URL+'action.php?resort=true&'+$("#sortable").sortable("serialize"), function(data) {	 });
		}});
		//$('#sortable').disableSelection();
</script>

</div>