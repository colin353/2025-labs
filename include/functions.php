<?php

include_once('defaults.php');

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



?>
