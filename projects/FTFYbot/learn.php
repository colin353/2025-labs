<?php

include('functions.php');
include('connect.php');

if(isset($_REQUEST['url'])) $url = $_REQUEST['url'];
else $url = 'http://www.reddit.com/r/AskReddit/comments/lqvz3/bartenders_of_reddit_whats_the_bestworst/';
try {
$str = file_get_contents($url.'/.json','r');
} catch(Exception $deception) { $str = ''; }

($twitter_data = json_decode($str,true));

$comments = $twitter_data[1]['data']['children'];

$p = "/[^A-Z\s\?\.\,']/";

$old_id = 0;

function insertWord($w) {

	global $old_id;
	$w = mysql_escape_string($w);

    $m = mysql_query("select idea_id from ideas where idea_raw = '$w'") or die(mysql_error());
   if(mysql_num_rows($m) == 0) {
   		// It is a new idea never before seen
   		// Generate a random region and insert
   		$r = '';
   		
   		mysql_query("insert into ideas (idea_raw,idea_region) values
   					 ('$w','$r')");
		$this_idea = mysql_insert_id();
		mysql_query("insert into relationships (relationship_idea1, relationship_idea2, relationship_context) values
					($old_id, $this_idea,'')");
   } else {
   		// We have seen this idea before
   		$this_idea = mysql_fetch_assoc($m);
		$this_idea = $this_idea['idea_id'];
		
		// Did we see this relationship before? 
		$relationships = mysql_query("select relationship_id from relationships where relationship_idea1=$old_id and relationship_idea2=$this_idea");
   		if(mysql_num_rows($relationships) > 0) { // We saw it before, increment relationship strength
   			$rid = mysql_fetch_assoc($relationships);
   			$rid = $rid['relationship_id'];
   			mysql_query("update relationships set relationship_strength = (relationship_strength + 1) where relationship_id = $rid");	
   		} else { // We did not saw it before, make new relaysh
   			mysql_query("insert into relationships (relationship_idea1, relationship_idea2, relationship_context) values
   					     ($old_id, $this_idea, '')");		
   		}
   		
   }
   $old_id = $this_idea;
   echo "$w=>";
}

foreach($comments as $k) {
    $c = $k['data']['body'];
    $c = strip_tags($c);
    $c = strtoupper($c);
    $c = preg_replace($p,'',$c);
    foreach(explode('.',$c) as $s) {
        foreach(explode(' ',$s) as $w) {
            if($w == '') continue;
            insertWord(preg_replace('/[\.\,\?\s]/','',$w));
                       
            if(substr($w, -1) == ',') insertWord('comma');
            else if(substr($w, -1) == '?') insertWord('questionmark');
        }
        insertWord("period");
        echo "<br /><br />";       
    }
   
   
}

?>