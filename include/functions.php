<?php

include_once('defaults.php');

function isAuthenticated() {
	if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == "true") return true;
	else return false;
} 

function getFirstName($name) {
	//if($name == $_SESSION['user_realname']) return "";
	$n = explode(" ",$name);
	return $n[0];
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
