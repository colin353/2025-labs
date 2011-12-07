<?php 
include('../../include/init.php');
include('../include/auth_head.php');


if(isset($_REQUEST['addTask'])) {
	$u = mysql_real_escape_string($_REQUEST['u']);
	$u = trim($u); // remove whitespace;
	$u = mysql_fetch_assoc(mysql_query($q = "select * from users where user_name LIKE '%$u%' or user_realname like '%$u%' limit 1")) or die(mysql_error());

	$u = $u['user_id'];
	$d = mysql_real_escape_string($_REQUEST['d']);
	$p = mysql_real_escape_string($_REQUEST['p']);
	
	$p = trim($p);
	$p_t = @mysql_fetch_assoc(mysql_query($q = "select * from projects where project_code = '$p'"));

	if(!$p_t) {
		$p_t = 363;
		$x = $p;
	} else {
		$x = 0;
		$p_t = $p_t['project_id'];
	}
	if($_SESSION['user_id'] != $u) { // somebody else is adding a message for you
		sendEmailMessage($u,"<b>".$_SESSION['user_realname']."</b> added something to your task list. ");
	}
	if($_REQUEST['state'] == 0) mysql_query("insert into todo_todolist (task_description, project_id, id_user, project_extra) values ('$d','$p_t','$u','$x')");
	else mysql_query($q = "insert into todo_todolist (task_description, project_id, id_user, project_extra, completed, time_completed) values ('$d','$p_t','$u','$x',1,NOW())");

} elseif(isset($_REQUEST['getTask']) && $_REQUEST['getTask'] == 0) {
	$s = mysql_real_escape_string($_REQUEST['s']);
	
	// is the selector a username?
	$u_t = @mysql_fetch_assoc(mysql_query($q = "select * from users where user_realname LIKE '%$s%' or user_name like '%$s%' limit 1"));
	if($u_t) {
		// We must be talking about a user
		$dp = 'dude';
		$u = $u_t['user_id'];
		$ts =mysql_query("select * from todo_todolist, users where user_id = id_user and id_user = '$u' and completed=0 order by order_person asc");
	} else {
		// We must be talking about a project
		$dp = 'project';
		$p_t = @mysql_fetch_assoc(mysql_query($q = "select * from projects where project_code LIKE '%$s%'"));
		$p_t = $p_t['project_id'];
		$ts =mysql_query("select * from todo_todolist, users where user_id = id_user and project_id = '$p_t' and completed=0 order by order_project asc");
	}
	echo "<ul contenteditable=false>";
	while($t = mysql_fetch_assoc($ts)) {
		echo "<li><input type=hidden value=".$t['id_task_pk']." /><input type=checkbox "; 
		if($t['completed']) echo "checked";
		echo " /><b>".$t['user_name'];
		echo "</b> should ".$t['task_description'];
		echo " for <b>";
		$p_t = mysql_fetch_assoc(mysql_query("select project_code from projects where project_id = '".$t['project_id']."'"));
		if(!$p_t || $t['project_id'] == 363) $p_t = $t['project_extra'];
		else $p_t = $p_t['project_code'];
		
		echo $p_t."</b></li>";
	}
	echo "<input type=hidden id='dude-or-project' value=".$dp." />";
	echo "</ul>";
	
} elseif(isset($_REQUEST['getTask']) && $_REQUEST['getTask'] == 1) {
	$s = mysql_real_escape_string($_REQUEST['s']);
	$w = mysql_real_escape_string($_REQUEST['w']);
	$w = intval($w);
	// is the selector a username?
	$u_t = @mysql_fetch_assoc(mysql_query($q = "select * from users where user_name LIKE '%$s%' or user_realname like '%$s%' limit 1"));
	if($u_t) {
		$dp = 'dude';
		// We must be talking about a user
		$u = $u_t['user_id'];
		$ts =mysql_query("select *,unix_timestamp(time_completed) as t from todo_todolist, users where user_id = id_user and id_user = '$u' and completed=1 and unix_timestamp(time_completed) > ".(time() - 604800 - $w*604800)." and unix_timestamp(time_completed) < ".(time()+1-$w*604800)." order by time_completed desc");
	} else {
		$dp = 'project';
		// We must be talking about a project
		$p_t = @mysql_fetch_assoc(mysql_query($q = "select *  from projects where project_code LIKE '%$s%'"));
		$p_t = $p_t['project_id'];
		$ts =mysql_query("select *,unix_timestamp(time_completed) as t from todo_todolist, users where user_id = id_user and project_id = '$p_t' and completed=1 and time_completed > ".(time() - $w*604800 - 604800)." and unix_timestamp(time_completed) < ".(time()+1-$w*604800)." order by time_completed desc ");
	}
	$day = 'nine';
	if($w > 0) echo "<p onClick='week--;reload_ajax()' >Next week...</p>";
	while($t = mysql_fetch_assoc($ts)) {
		$day_n = date('l, jS \of F',$t['t']);
		if(strcmp($day_n,date('l, jS \of F')) ==0) $day_n .= " (today)";
		if(!(strcmp($day_n,$day)==0)) {
			if($day != 'nine') echo "</ul>";
			$day = $day_n;
			echo "<p>".$day."</p>";
			echo "<ul contenteditable=false>";
		}
		echo "<li><input type=hidden value=".$t['id_task_pk']." /><input type=checkbox ";
		if(time()-$t['t'] > 11000) echo "disabled=disabled";
		if($t['completed']) echo " checked ";
		echo " /><b>".$t['user_name'];
		echo "</b> did ".$t['task_description'];
		echo " for <b>";
		$p_t = mysql_fetch_assoc(mysql_query("select project_code from projects where project_id = '".$t['project_id']."'"));
		if(!$p_t || $t['project_id'] == 363) $p_t = $t['project_extra'];
		else $p_t = $p_t['project_code'];
		
		echo $p_t."</b></li>";
	}
	echo "</ul>";
	echo "<p onClick='week++;reload_ajax()' >Prior week...</p>";
	echo "<input type=hidden id='week' value=0 />";
	echo "<input type=hidden id='dude-or-project' value=".$dp." />";
}
elseif(isset($_REQUEST['sort'])) {
	$c=0;
	if($_REQUEST['dp'] == 'dude') $op = "order_person";
	else $op = "order_project";
	foreach($_REQUEST['order'] as $id) {
		$id = mysql_real_escape_string($id);
		mysql_query($q ="update todo_todolist set $op = $c where id_task_pk = '$id'");
		echo $q;
		$c++;
	}
	
}
elseif(isset($_REQUEST['complete'])) {
	$i = mysql_real_escape_string($_REQUEST['id']);
	mysql_query("update todo_todolist set completed = (1- completed), time_completed= NOW() where id_task_pk = '$i'") or die(mysql_error());
	
} elseif(isset($_REQUEST['deleteTask'])) {
	$id =  mysql_real_escape_string($_REQUEST['id']);
	mysql_query("delete from todo_todolist where id_task_pk = '$id'");
}



?>