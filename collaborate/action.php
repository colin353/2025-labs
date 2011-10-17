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
else if(isset($_REQUEST['fundrequest']) && $_REQUEST['fundrequest'] == 'true') {
		$r = mysql_real_escape_string($_REQUEST['r']);	
		$u = $_SESSION['user_id'];
		$a = mysql_real_escape_string($_REQUEST['a']);
		$code = mysql_real_escape_string($_REQUEST['code']);
		$total = $a;
		
		
		$freq = myQuery("select * from fundingrequests where fundingrequest_id = $r");
		$d = $freq['fundingrequest_debtor'];
		$note = 'funding a funding request';
		if(myBalance() >= $a) { // If we can afford it using our shareholder account only...
		
			$freq = myQuery("select * from accounts where account_type = 'shareholder' and account_owner_id = $u");
			$c = $freq['account_id'];
			mysql_query("insert into transactions (transaction_debtor, transaction_creditor, transaction_note, transaction_fundingrequest_id,transaction_value,transaction_code) values ($d, $c, '$note', $r, $a,'$code')") or die(mysql_error());
			$insert_id = mysql_insert_id();		
			$acc = myQuery("select * from accounts where account_id = $d");
			$pid = $acc['account_owner_id'];
			eventLog("funded a project",$insert_id,$pid); // working
		} else {
			$a = myBalance();
			$freq = myQuery("select * from accounts where account_type = 'shareholder' and account_owner_id = $u");
			$c = $freq['account_id'];
			mysql_query("insert into transactions (transaction_debtor, transaction_creditor, transaction_note, transaction_fundingrequest_id,transaction_value,transaction_code) values ($d, $c, '$note', $r, $a,'$code')") or die(mysql_error());
			$insert_id = mysql_insert_id();		
			$acc = myQuery("select * from accounts where account_id = $d");
			$pid = $acc['account_owner_id'];
			eventLog("funded a request",$insert_id,$pid); // working
			$a = $total - $a;
			$code = md5($code);
			$freq = myQuery("select * from accounts where account_type = 'pocket' and account_owner_id = $u");
			$c = $freq['account_id'];
			mysql_query("insert into transactions (transaction_debtor, transaction_creditor, transaction_note, transaction_fundingrequest_id,transaction_value,transaction_code) values ($d, $c, '$note', $r, $a,'$code')") or die(mysql_error());
			$insert_id = mysql_insert_id();		
			$acc = myQuery("select * from accounts where account_id = $d");
			$pid = $acc['account_owner_id'];
			eventLog("funded a request from his own pocket",$insert_id,$pid); // working
						
		}
		
		
} 
else if(isset($_REQUEST['fund_req']) && $_REQUEST['fund_req'] == "true") {
	foreach(array('q','desc','val','project_unique') as $k) $$k = mysql_real_escape_string($_REQUEST[$k]);		
	$u = $_SESSION['user_id'];
	echo $val."<br />";
	$val = str_replace(array('$',',',' '),'',$val)."<br />";
	$val = floatval($val);
	echo $val;
	if($val == 0) header("location: ".BASE_URL."new-fund-request/".$q);
		
	$debtor = myQuery("select account_id from accounts where account_type = 'project' and account_owner_id = $q");
	$debtor = $debtor['account_id'];
	mysql_query("insert into fundingrequests (fundingrequest_description,fundingrequest_creator_id,fundingrequest_value,fundingrequest_debtor) values ('$desc',$u,$val,$debtor)") or die(mysql_error());
	header("location: ".BASE_URL."funding-requests/".$q);
}
else if(isset($_REQUEST['income_report']) && $_REQUEST['income_report'] == "true") {
	foreach(array('q','desc','val','project_unique') as $k) $$k = mysql_real_escape_string($_REQUEST[$k]);		
	$u = $_SESSION['user_id'];
	echo $val."<br />";
	$val = str_replace(array('$',',',' '),'',$val)."<br />";
	$val = floatval($val);
	echo $val;
	if($val == 0) header("location: ".BASE_URL."new-fund-request/".$q);
		
	$debtor = myQuery("select account_id from accounts where account_type = 'project' and account_owner_id = $q");
	$debtor = $debtor['account_id'];
	$creditor = myQuery("select account_id from accounts where account_owner_id =0");
	$creditor = $creditor['account_id'];
	
	$project_unique = md5($project_unique);
	
	mysql_query($s = "insert into transactions (transaction_note,transaction_value,transaction_debtor,transaction_creditor,transaction_code) values ('$desc',$val,$debtor,$creditor,'$project_unique')") or die(mysql_error().$s);
	
	header("location: ".BASE_URL."funding-requests/".$q);
	
	balance_the_books($q,$val,$project_unique);
}

?>