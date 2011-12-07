<h1>Manual Cron</h1>
<p>Started at: <?php echo date("Y-m-d H:i:s"); ?></p>


<script>
	
	//setTimeout('window.close();',3000);
	
</script>


<?php

include('connect_db.php');
include('functions.php');

function send_mail($email,$message) {
	$f = fopen('C:/wamp/tools/mail_to_send','w');
	fwrite($f,$email."\n".$message);
	fclose($f);
	echo $message."<br />";
	echo exec("C:\\python32\\python.exe C:\\wamp\\tools\\mailsend.py");
	//unlink("C:/wamp/tools/mail_to_send");	
}

$ms = mysql_query("select * from users, messages where user_id = message_user_id and message_unsent = 1 order by user_id") or die(mysql_error());
$last = false;
if($m = mysql_fetch_assoc($ms)) while($last == false) {
	// Insert into the message body text
	$mail = $m['user_email'];
	echo "To: $mail<br />";
	$body =  "Hey ".($m['user_realname']).", \n\n"; 
	$body .= "There's been some activity on <a href=http://2025-labs.com>http://2025-labs.com</a> involving you!<br /><br />\n\n";
	
	$body .= $m['message_text']."\n\n<br /><br />";
	mysql_query("update messages set message_unsent = 0 where message_id=".$m['message_id']);
	
	$id = $m['user_id'];
	
	if($m = mysql_fetch_assoc($ms)) {
		if($m['user_id'] == $id) {
			$body .= $m['message_text']."<br /><br />\n\n";
			mysql_query("update messages set message_unsent = 0 where message_id=".$m['message_id']);
		} else continue;
	} else $last = true;
	
	$body .= 
"Laters,<br />\n
2025robot<br /><br />\n\n

--
2025bot<br />\n
Email sending robot<br /><br />\n\n

email: admin@2025-labs.com<br /><br />\n\n

<img width=144 height=59 src='http://2025-labs.com/images/2025-small.png'>"	;
		
send_mail($mail,$body);
} else {
	echo "<img src='http://ompldr.org/vYTh3cg/nothing-to-do-here-template.jpg' />";	
}


?>
