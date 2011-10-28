<?php

// Handle edits that come from this page...

if(isset($_REQUEST['editdesc'])) {
	$q = mysql_real_escape_string($_REQUEST['q']);
	$desc = mysql_real_escape_string($_REQUEST['desc']);
	mysql_query("update users set user_publicdesc = '$desc' where user_id=$q") or die(mysql_error());
} else if(isset($_REQUEST['editpass'])) {
	$q = mysql_real_escape_string($_REQUEST['q']);
	$pass = mysql_real_escape_string($_REQUEST['pass']);
	$pass = md5(DEFAULT_SALT.$pass);
	mysql_query("update users set user_pass = '$pass' where user_id=$q") or die(mysql_error());
}

if(!isset($_REQUEST['q'])) nope_chuck_testa();
else {
	$u = mysql_query('select * from users where user_id = '.mysql_real_escape_string($_REQUEST['q']));	
	if(mysql_num_rows($u) == 0) nope_chuck_testa();  
	$u = mysql_fetch_assoc($u);
} 

?>

<h1><?php echo $u['user_realname']?><span class=sidenote>(aka <?php echo $u['user_name']; ?>)</span></h1>
<p><b><?php echo COLLAB_PERSON_ENTRY1;?></b> <span><?php echo date('F jS Y',strtotime($u['user_creationdate'])); ?> </span></p>
<p><b><?php echo COLLAB_PERSON_ENTRY2;?></b> <span> <?php echo format_dollars(myBalance($u['user_id'])); ?> </span></p>
<p><b>Email:</b> <span> <?php echo $u['user_email']; ?> </span></p>

<br />
<h1><?php echo getFirstName($u['user_realname']) . COLLAB_PERSON_THEIR; ?></h1>

<?php

$projects = mysql_query('select * from projectmemberships,projects where projectmembership_project_id = project_id and projectmembership_user_id = '.mysql_real_escape_string($_REQUEST['q']));


if(mysql_num_rows($projects) == 0) {
	?>
	
	<p><?php echo COLLAB_PERSON_NOPROJECTS; ?></p>
	
	<?php
	
}
else while($p = mysql_fetch_assoc($projects)) {
	?>
	
	<h3><a href=<?php echo BASE_URL; ?>project/<?php echo $p['project_id']; ?>><?php echo $p['project_name']; ?></a><span class=sidenote><?php echo $p['project_description']; ?></span></h3>
	
	<?php
}

if($_SESSION['user_id'] == $_REQUEST['q']) {

?>
<br />
<h1>Public description:</h1>

<form method=post class=inputForm>
<p>Write a brief description of yourself for the public.</p><textarea placeholder="Brief description of yourself" name=desc value=""><?php echo $u['user_publicdesc']; ?></textarea>
<input type=hidden name=editdesc value=true />
<br /><input type=submit value="Submit"/>
</form>
<h1>Change Password:</h1>
<form method=post onSubmit="return ($('#pass').val() == $('#pass2').val())" class=inputForm>
	<p>New Password:</p><input type=password placeholder="" name=pass id=pass value="" /></span><br />
	<p>Confirm psasword:</p><input type=password placeholder="" id=pass2 	value="" /></span><br />
	<input type=hidden name=editpass value=true />
	<input type=submit value="Set New Password"/>
</form>

<?php } ?>
