<?php 

include('connect.php');



if(isset($_REQUEST['id'])) $id = $_REQUEST['id'];
else $id = rand(1,2303);

$word = mysql_query($q = "select * from ideas where idea_id = '$id'") or die(mysql_error());
$word = mysql_fetch_assoc($word);
echo ucfirst(strtolower($word['idea_raw']));
	
$caps = false;
$nid = $word['idea_id'];
for($i=1;$i<64;$i++) {
		
	$next = mysql_query($q = "select * from relationships,ideas where idea_id = relationship_idea2 and relationship_idea1 = ".$nid." order by (rand()*20+relationship_strength) limit 0,1");
	if($n = mysql_fetch_assoc($next)) {
		$id = $n['idea_id'];
		
		if($n['idea_raw'] == 'comma') echo ",";
		else if($n['idea_raw'] == 'period') {
			$caps =true; echo ".";
			if($i > 32) break;
		}
		else if($n['idea_raw'] == 'questionmark') {
			$caps =true; echo "?";
			if($i > 32) break;
		}
		else if($caps) {
			echo " ".ucfirst(strtolower($n['idea_raw']));
			$caps =false;
		}
		else echo " ".strtolower($n['idea_raw']);
	} else break;
		
	$nid = $n['idea_id'];

}

?>