<?php 

include('include/auth_head.php');

// if status = true, then this is a request to create a status update on a project

if(isset($_REQUEST['status']) && $_REQUEST['status'] == true) {
	$q = mysql_real_escape_string($_REQUEST['q']);
	$pid = mysql_real_escape_string($_REQUEST['p']);
	
	$uid = $_SESSION['user_id'];
	
	mysql_query("insert into projectstatus (projectstatus_status, projectstatus_user_id, projectstatus_project_id) values ('$q',$uid,$pid)") or die(mysql_error());
	
	eventLog("wrote a new project status update",mysql_insert_id(),$pid); // works yay lol
} 

else if(isset($_REQUEST['resource']) && $_REQUEST['resource'] == true) {

	$q = mysql_real_escape_string($_REQUEST['q']);
	$pid = mysql_real_escape_string($_REQUEST['p']);
	$t = mysql_real_escape_string($_REQUEST['t']);
	
	mysql_query("insert into projectresource (projectresource_title, projectresource_value, projectresource_project_id) values ('$t','$q',$pid)") or die(mysql_error());
	eventLog("created a new project resource",mysql_insert_id(),$pid);  // works sweet
} 
else if(isset($_REQUEST['newtask']) && $_REQUEST['newtask'] == true) {

	$u = mysql_real_escape_string($_REQUEST['u']);
	$m = mysql_real_escape_string($_REQUEST['m']);
	$t = mysql_real_escape_string($_REQUEST['t']);
	$p = mysql_fetch_assoc(mysql_query("select * from todolistmilestone where todolistmilestone_id = $m"));
	
	mysql_query("insert into todolist (todolist_user_id, todolist_text, todolist_milestone_id) values ($u,'$t',$m)") or die(mysql_error());
	eventLog("created a new task",mysql_insert_id(),$p['todolistmilestone_project_id']); // works sweet
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
	
	eventLog("created a new project milestone",mysql_insert_id(),$p); // works
} 

else if(isset($_REQUEST['complete_task']) && $_REQUEST['complete_task'] == true) {
	
	$t = mysql_real_escape_string($_REQUEST['t']);
	$s = mysql_real_escape_string($_REQUEST['s']);
		
	mysql_query("update todolist set todolist_status = $s where todolist_id=$t limit 1") or die(mysql_error());
	$p = mysql_fetch_assoc(mysql_query("select * from todolistmilestone,todolist where todolistmilestone_id = todolist_milestone_id and todolist_id = $t"));
	echo '"'.$s.'"';
	if($s == 'true') $comp = ''; else $comp = "un";
	eventLog($comp."completed a task",$t,$p['todolistmilestone_project_id']); // working now
}
else if(isset($_REQUEST['resort']) && $_REQUEST['resort'] == true) {
	$i=0; $f=0;
	foreach($_REQUEST['milestone'] as $id) {
		$id = mysql_real_escape_string($id);
		mysql_query("update todolistmilestone set todolistmilestone_order=$i where todolistmilestone_id = $id limit 1") or die(mysql_error());
		$i++;
		$f = $id;
	} 
	$p = mysql_fetch_assoc(mysql_query("select * from todolistmilestone,todolist where todolistmilestone_id = todolist_milestone_id and todolistmilestone_id = $f"));
	eventLog("re-ordered some milestones",$f,$p['todolistmilestone_project_id']); 
	
}
else if(isset($_REQUEST['deletetask']) && $_REQUEST['deletetask'] == true) {
		$id = mysql_real_escape_string($_REQUEST['id']);	
		$p = mysql_fetch_assoc(mysql_query("select * from todolistmilestone,todolist where todolistmilestone_id = todolist_milestone and todolist_id = $id"));
		mysql_query("delete from todolist where todolist_id = $id limit 1") or die(mysql_error());
		eventLog("deleted a task",$id,$p['todolistmilestone_project_id']); // works
} 

else if(isset($_REQUEST['deletemilestone']) && $_REQUEST['deletemilestone'] == true) {
		$id = mysql_real_escape_string($_REQUEST['id']);	
		$p = mysql_fetch_assoc(mysql_query("select * from todolistmilestone where todolistmilestone_id = $id"));
		mysql_query("delete from todolistmilestone where todolistmilestone_id = $id limit 1") or die(mysql_error());
		eventLog("deleted a milestone",$id,$p['todolistmilestone_project_id']); // works
} 
else if(isset($_REQUEST['addmetoproject']) && $_REQUEST['addmetoproject'] == true) {
		$pid = mysql_real_escape_string($_REQUEST['id']);	
		$id = $_SESSION['user_id'];
		$rol = mysql_real_escape_string($_REQUEST['rol']);
		mysql_query("insert into projectmemberships (projectmembership_user_id, projectmembership_project_id,projectmembership_role) values ($id, $pid,'$rol')") or die(mysql_error());
		eventLog("added themselves as a member",mysql_insert_id(),$pid); // working
} 
else if(isset($_REQUEST['create']) && $_REQUEST['create'] == "true") {
		$project_name = mysql_real_escape_string($_REQUEST['project_name']);
		$project_description = mysql_real_escape_string($_REQUEST['project_description']);
		$project_salespitch = mysql_real_escape_string($_REQUEST['project_salespitch']);
		$project_unique = mysql_real_escape_string($_REQUEST['project_unique']);
		$project_owner = $_SESSION['user_id'];
		
		mysql_query("insert into projects (project_name,project_description,project_salespitch,project_unique,project_creator_id) values('$project_name','$project_description','$project_salespitch',$project_unique,$project_owner)") or die(mysql_error());
		eventLog("created a project",$i=mysql_insert_id(),mysql_insert_id());
		
		mysql_query("insert into projectmemberships (projectmembership_project_id,projectmembership_user_id) values (".$i.",$project_owner)") or die(mysql_error());
		
		mysql_query("insert into accounts (account_owner_id,account_type) values ($i,'project')");
		
		header("Location: ".BASE_URL."projects");
}


?>