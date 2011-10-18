<?php 

if(isset($_REQUEST['create'])) {
	
	foreach(array('username','realname','pass') as $k) $$k = mysql_real_escape_string($_REQUEST[$k]);	
	if($username != '' && $realname != "" && $pass != "") { 
		$pass = md5(DEFAULT_SALT.$pass);
		mysql_query("insert into users (user_name, user_realname, user_pass) values ('$username','$realname','$pass')");
		$iid = mysql_insert_id();
		$desc = getFirstName($realname)."\'s pocket account";
		mysql_query("insert into accounts (account_owner_id,account_type,account_description) values ($iid,'pocket','$desc')");
		
		$desc = getFirstName($realname)."\'s shareholder account";
		mysql_query("insert into accounts (account_owner_id,account_type,account_description) values ($iid,'shareholder','$desc')");
		
		echo "<span>User created</span>";	
		
		eventLog('created a new user',$iid);
	}
}

?>

<h1>Create new user</h1>
<form method=post onSubmit="return ($('#pass').val() == $('#pass2').val())" class=inputForm>
<p>Username:</p><input type=text placeholder="jsmith" name=username value="" /></span><br />
<p>Real name:</p><input type=text placeholder="John Smith" name=realname value="" /></span><br />
<p>Password:</p><input type=password placeholder="" name=pass id=pass value="" /></span><br />
<p>Confirm psasword:</p><input type=password placeholder="" id=pass2 	value="" /></span><br />
<input type=hidden name=create value=true />
<input type=hidden name=project_unique value=<?php echo rand().rand(); ?> /><br />
<input type=submit value="hwaiting"/>
</form>