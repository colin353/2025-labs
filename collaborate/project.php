<?php

$id = mysql_real_escape_string($_SESSION['user_id']);
$q = mysql_real_escape_string($_REQUEST['q']);
if(mysql_num_rows(mysql_query("select * from projectmemberships where projectmembership_user_id = $id and projectmembership_project_id = $q")) == 0 )
	$header_sidenote = "<a href=# onClick=askToAddProj($q) >+ ".COLLAB_PROJ_ADD_ME."</a>"; 	
else $header_sidenote = '';

include('include/header-project.php');

?>

<script>
	function askToAddProj(q) {
		var reply = prompt("<?php echo COLLAB_ROLE_Q; ?>", "")
		if(reply == null) return;
		else addMeToProject(q,reply);
	}
	
</script>

<?php 

$pstat = getProjectState($_REQUEST['q']);

?>

<p><h2><?php echo COLLAB_PROJECT_STATE; ?></h2> <?php echo $pstat['current']; ?></p>

<span>Next milestone: <b><?php echo $pstat['next']; ?></b>, <?php echo COLLAB_PCTC1." ".$pstat['percentagecomplete']."% ".COLLAB_PCTC2; ?></span><br />
<div id=progressbar> </div>

<script>
	    $(document).ready(function() {
  		  $("#progressbar").progressbar({ value: <?php echo $pstat['percentagecomplete']; ?> });
  		});
</script>


<br />


<p><h2><?php echo COLLAB_PROJECT_LATESTUPDATE; ?></h2><span class=sidenote>
	
	<?php
	
	if(mysql_num_rows(mysql_query('select * from projectmemberships where projectmembership_project_id = '.mysql_real_escape_string($_REQUEST['q']).' and projectmembership_user_id='.$_SESSION['user_id'])) > 0) {  ?>
	
	<a onClick=addNewThing()>+ <?php echo COLLAB_PROJECT_ADDUPDATE; ?></a>
	
	<?php
	
	}
	
	?>
	
</p>
	
<div id=new_status_update class=hiding>
	<form onSubmit='return new_status();' >
		<input type="text" value="" id=the_data placeholder="<?php echo COLLAB_PLACE_STATUS_P; ?>" /><span class=sidenote>-- <?php echo $_SESSION['user_realname']; ?></span>		
		<input type="submit" value="Submit the form!" style="position: absolute; top: 0; left: 0; z-index: 0; width: 1px; height: 1px; visibility: hidden;" />
	</form>
	
</div>
	
<?php

$statuss = mysql_query('select *,unix_timestamp(projectstatus_creationdate) as t from projectstatus,users where projectstatus_user_id = user_id and projectstatus_project_id = '.mysql_real_escape_string($_REQUEST['q']).' order by projectstatus_creationdate desc limit 0,3') or die(mysql_error());
while($status = mysql_fetch_assoc($statuss)) {

?>
<p><span><?php echo $status['projectstatus_status']; ?></span><span class=sidenote>-- <?php echo $status['user_realname']; ?>, <?php echo time_to_string(time()-$status['t']); ?></span></p>

<?php } ?>

<br />
<p><h2><?php echo COLLAB_PROJECT_MEMBERS; ?></h2></p>

<?php 

$people = mysql_query('select * from users,projectmemberships where projectmembership_project_id = '.mysql_real_escape_string($_REQUEST['q']).' and projectmembership_user_id = user_id');

while($d = mysql_fetch_assoc($people)) {
	
	if($p['project_creator_id'] == $d['user_id']) {
		$king = COLLAB_PROJ_CREATOR;
		if($d['projectmembership_role'] != "") $king = ", ".$king;
	}
	
	else $king = "";
	
	?>
	
	<h3><a href=<?php echo BASE_URL; ?>person/<?php echo $d['user_id']; ?>><?php echo $d['user_realname']; ?></a><span class=sidenote><?php echo $d['projectmembership_role'].$king; ?></span></h3>
	
	
	<?php
}

?>

<br />
<p><h2><?php echo COLLAB_PROJECT_RESOURCE; ?></h2></b><span class=sidenote>
	
	<?php
	
	if(mysql_num_rows(mysql_query('select * from projectmemberships where projectmembership_project_id = '.mysql_real_escape_string($_REQUEST['q']).' and projectmembership_user_id='.$_SESSION['user_id'])) > 0) {  ?>
	
	<a onClick=addNewResource()>+ <?php echo COLLAB_PROJECT_ADDRESOURCE; ?></a>
	
	<?php
		
	}
	
	?>
	
</span></p>
<div id=new_resource class=hiding>
	<form onSubmit='return new_resource();' >
		<input type="text" value="" id=the_resource_title placeholder="<?php echo COLLAB_PROJ_RES; ?>" /><input type="text" value="" id=the_resource_data placeholder="<?php echo COLLAB_PROJ_RES2; ?>" />		
		<input type="submit" value="Submit the form!" style="position: absolute; top: 0; left: 0; z-index: 0; width: 1px; height: 1px; visibility: hidden;" />
	</form>
	
</div>
<?php

$resources = mysql_query('select * from projectresource where projectresource_project_id= '.mysql_real_escape_string($_REQUEST['q']).' order by projectresource_title asc limit 0,3') or die(mysql_error());
while($resource = mysql_fetch_assoc($resources)) {

?>
<p><span class=leftcol><?php echo $resource['projectresource_title']; ?></span><span class=rightcol><?php echo encapsulateIfURL($resource['projectresource_value']); ?></span></p>

<?php } ?>



