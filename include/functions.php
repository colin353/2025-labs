<?php

include_once('defaults.php');


function nope_chuck_testa() {
	include('404.php');
	exit;
}

function isAuthenticated() {
	if(isset($_SESSION['authenticated']) && isset($_SESSION['time']) && $_SESSION['authenticated'] == "true" && time() - $_SESSION['time'] < 60*MINUTES_UNTIL_LOGOUT) {
		$_SESSION['time'] = time();
		return true;
	}
	else return false;
} 

function getFirstName($name) {
	//if($name == $_SESSION['user_realname']) return "";
	$n = explode(" ",$name);
	return $n[0];
}

function time_to_string($td) {

    if ($td > 60*60*24*365)  { $tn > round($td/(3600 * 24 * 365)); $tp = 'year'; }
    else if   ($td > 60*60*24*30)  { $tn = round($td/(3600 * 24 * 30)); $tp = 'month'; }
    else if   ($td > 60*60*24*7)  { $tn = round($td/(3600 * 24 * 7)); $tp = 'week'; }
    else if   ($td > 60*60*24 ) {  $tn = round($td/(3600 * 24)); $tp =  'day'; }
    else if   ($td > 60*60) { $tn = round($td/3600); $tp = 'hour'; }
    else if   ($td > 60) { $tn = round($td/60); $tp = 'minute'; }
    else if   ($td > 0) { $tn = $td; $tp =  'second'; }
	else return "just now";
   
    if($tn > 1) $tp = $tp . 's';


    return $tn . ' ' . $tp . ' ago';

   
}

function myQuery($q,$debug = false) {
	if($debug) echo $q;
	$qr = mysql_query($q) or die(mysql_error());
	return mysql_fetch_assoc($qr);
	
}

function format_dollars($number) {
	return "$".number_format($number,2);
}

function truncate_string($str,$char) {
    if(strlen($str) > $char) {
        $story = substr($str,0,$char-3);
        $story = $story . '...';
    } else {
        $story = $str;       
    }
   
    return $story;   
}

function encapsulateIfURL($string) {
	if(preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $string)) return "<a href='$string'>$string</a>";
	else return $string;	
}

function displayActionMenu($k) {
?>
<div class=actions>	
	<ul>
		<?php foreach($k as $w => $l) { ?><li onClick=actionMenu('<?php echo BASE_URL.$l; ?>')><?php echo $w; ?></li><?php } ?>
	</ul>
</div>



<?php
}

function getProjectState($pid) {
	$pid = mysql_real_escape_string($pid);
	$ps = mysql_query("select *, ( (select count(*) from todolist where todolist_status = 1 and todolist_milestone_id = todolistmilestone_id) / (select count(*) from todolist where todolist_milestone_id = todolistmilestone_id))  as percentagecomplete
				from todolistmilestone where todolistmilestone_project_id = $pid order by todolistmilestone_order asc") or die(mysql_error());
	
	
	$res['current'] = "initial development";
	$res['next'] = "initial development";
	$res['percentagecomplete'] = 0;
	$res['next_id'] = 0; 
	$res['curr_id'] = 0;
	while($m = mysql_fetch_assoc($ps)) {
		if($m['percentagecomplete'] == 1) {
			$res['current'] = $m['todolistmilestone_name'];
			$res['curr_id'] = $m['todolistmilestone_id'];
		}
		else {
			 $res['next'] = $m['todolistmilestone_name'];
			 $res['percentagecomplete'] = round(100*$m['percentagecomplete']);
			 $res['next_id'] = $m['todolistmilestone_id'];
			 return $res;
			 break;
		}				
	}
	
	return $res;
				
}

function eventLog($t,$id=0,$pid=0) {
	if($pid == null) $pid = 0;
	if($id == null) $id = 0;
	$t = mysql_real_escape_string($t);
	$pid = mysql_real_escape_string($pid);
	$id = mysql_real_escape_string($id);
	$uid = $_SESSION['user_id'];
	
	mysql_query("insert into events (event_text, event_user_id, event_project_id, event_relevant_id) values ('$t',$uid,$pid,$id)") or die(mysql_error());
	
}

function greet() {
		$gc = 0;
		$greets[$gc++] = "Good to see you";
		$greets[$gc++] = "Welcome back";
		$greets[$gc++] = "Well hello";
		$greets[$gc++] = "Ahoy";
		$greets[$gc++] = "The prodigal son returns";
		if(date("a") == "pm") $greets[$gc++] = "Good afternoon";
		else $greets[$gc++] = "Good morning";
		
		return $greets[rand(0,$gc-1)].", ".getFirstName($_SESSION['user_realname']).".";
	
}

function myBalance() {
	$u = $_SESSION['user_id'];
	
	$balance = 0;
	
	$debits = mysql_fetch_assoc(mysql_query($queros="select sum(transaction_value) as t from transactions,accounts as ac_d, accounts as ac_c where ac_d.account_owner_id = $u and ac_d.account_id = transaction_debtor and ac_c.account_id = transaction_creditor and ac_d.account_type = 'shareholder'"));
	
	$balance += $debits['t'];
	
	$credits = mysql_fetch_assoc(mysql_query($queros="select sum(transaction_value) as t from transactions,accounts as ac_d, accounts as ac_c where ac_c.account_owner_id = $u and ac_d.account_id = transaction_debtor and ac_c.account_id = transaction_creditor and ac_c.account_type = 'shareholder'"));
	
	$balance -= $credits['t'];
	
	return $balance;
	
}



?>
