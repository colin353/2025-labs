<?php

function nope_chuck_testa() {
	?>
	<p>I bet you thought that was a real project ID.</p>
	<h1>NOPE!</h1>
	<p>-- Chuck Testa</p>
	<?php
	
	return;
}

if(!isset($_REQUEST['q'])) nope_chuck_testa();
else {
	$p = mysql_query('select * from projects where project_id = '.mysql_real_escape_string($_REQUEST['q']));	
	if(mysql_num_rows($p) == 0) nope_chuck_testa();  
	$p = mysql_fetch_assoc($p);
} 
?>

<h1><?php echo $p['project_name']; ?></h1>
<p><?php echo $p['project_description']; ?> </p>
<br />
<h2>Project members:</h2>

<?php 

$people = mysql_query('select * from users,projectmemberships where projectmembership_user_id = user_id');

while($d = mysql_fetch_assoc($people)) {
	
	if($p['project_creator_id'] == $d['user_id']) $king = ", project creator";
	else $king = "";
	
	?>
	
	<h3><a href=<?php echo BASE_URL; ?>person/<?php echo $d['user_id']; ?>><?php echo $d['user_realname']; ?></a><span class=sidenote><?php echo $d['projectmembership_role'].$king; ?></span></h3>
	
	
	<?php
}

?>
<br />

<script type=text/javascript>
	
	function addNewThing() {
		$('#new_status_update').show('fast');		
	}
	
	function new_status() {
				$.post('<?php echo BASE_URL; ?>action.php',{status: true, p: <?php echo $p['project_id']; ?>, q: $("#the_data").val()}, function(data) {
				  			window.location.reload(true);
 					 }
				);
				return false;
	}
	
</script>

<p><b>Latest status updates: </b><span class=sidenote>
	
	<?php
	
	if(mysql_num_rows(mysql_query('select * from projectmemberships where projectmembership_project_id = '.mysql_real_escape_string($_REQUEST['q']).' and projectmembership_user_id='.$_SESSION['user_id'])) > 0) {  ?>
	
	<a onClick=addNewThing()>+ new status update</a>
	
	<?php
	
	}
	
	?>
	
</p>
	
<div id=new_status_update>
	<form onSubmit='return new_status();' >
		<input type="text" value="" id=the_data placeholder="Status update here..." /><span class=sidenote>-- <?php echo $_SESSION['user_realname']; ?></span>		
		<input type="submit" value="Submit the form!" style="position: absolute; top: 0; left: 0; z-index: 0; width: 1px; height: 1px; visibility: hidden;" />
	</form>
	
</div>
	
<?php

$statuss = mysql_query('select * from projectstatus,users where projectstatus_user_id = user_id and projectstatus_project_id = '.mysql_real_escape_string($_REQUEST['q']).' order by projectstatus_creationdate desc limit 0,3') or die(mysql_error());
while($status = mysql_fetch_assoc($statuss)) {

?>
<p><span><?php echo $status['projectstatus_status']; ?></span><span class=sidenote>-- <?php echo $status['user_realname']; ?>, about 15 minutes ago</span></p>

<?php } ?>

<h2></h2>