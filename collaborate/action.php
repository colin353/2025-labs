<?php 

include('include/auth_head.php');

// if status = true, then this is a request to create a status update on a project

if(isset($_REQUEST['status']) && $_REQUEST['status'] == true) {

	$q = mysql_real_escape_string($_REQUEST['q']);
	$pid = mysql_real_escape_string($_REQUEST['p']);
	$uid = $_SESSION['user_id'];
	
	mysql_query("insert into projectstatus (projectstatus_status, projectstatus_user_id, projectstatus_project_id) values ('$q',$uid,$pid)") or die(mysql_error());
	
} 

else if(isset($_REQUEST['resource']) && $_REQUEST['resource'] == true) {

	$q = mysql_real_escape_string($_REQUEST['q']);
	$pid = mysql_real_escape_string($_REQUEST['p']);
	$t = mysql_real_escape_string($_REQUEST['t']);
	
	mysql_query("insert into projectresource (projectresource_title, projectresource_value, projectresource_project_id) values ('$t','$q',$pid)") or die(mysql_error());
	
} 
else if(isset($_REQUEST['newtask']) && $_REQUEST['newtask'] == true) {

	$u = mysql_real_escape_string($_REQUEST['u']);
	$m = mysql_real_escape_string($_REQUEST['m']);
	$t = mysql_real_escape_string($_REQUEST['t']);
	
	mysql_query("insert into todolist (todolist_user_id, todolist_text, todolist_milestone_id) values ($u,'$t',$m)") or die(mysql_error());
	
} 
else if(isset($_REQUEST['newmilestone']) && $_REQUEST['newmilestone'] == true) {

	$p = mysql_real_escape_string($_REQUEST['p']);
	$t = mysql_real_escape_string($_REQUEST['t']);
	$order = mysql_query("select * from todolistmilestone where todolistmilestone_project_id = $p order by todolistmilestone_order desc limit 0,1");
	if(mysql_num_rows($order) == 0) $order = 1;
	else {
		$order = mysql_fetch_assoc($order);
		$order = $order['todolistmilestone_order'] + 1;
		
	}
	mysql_query("insert into todolistmilestone (todolistmilestone_name, todolistmilestone_project_id, todolistmilestone_order) values ('$t',$p,$order)") or die(mysql_error());
	
} 
?>