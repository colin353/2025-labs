<?php 

include('../include/init.php');

// if status = true, then this is a request to create a status update on a project

if(isset($_REQUEST['status']) && $_REQUEST['status'] == true) {

	$q = mysql_real_escape_string($_REQUEST['q']);
	$pid = mysql_real_escape_string($_REQUEST['p']);
	$uid = $_SESSION['user_id'];
	
	mysql_query("insert into projectstatus (projectstatus_status, projectstatus_user_id, projectstatus_project_id) values ('$q',$uid,$pid)") or die(mysql_error());
	
} 

?>