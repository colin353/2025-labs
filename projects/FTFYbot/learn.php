<?php

$con = mysql_connect("localhost","vmc009","Aug08T11+Tnc");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('PROXXX_dev2',$con) or die(mysql_error());

if(isset($_REQUEST['url'])) $url = $_REQUEST['url'];
else $url = 'http://www.reddit.com/r/AskReddit/comments/lqvz3/bartenders_of_reddit_whats_the_bestworst/';
try {
$str = file_get_contents($url.'/.json','r',$ctx);
} catch(Exception $deception) { $str = ''; }

($twitter_data = json_decode($str,true));

$comments = $twitter_data[1]['data']['children'];

$p = "/[^A-Z\s\?\.\,']/";



function insertWord($w) {
    if($w == 'period')
    $m = mysql_query("select * from ideas where idea_raw = '$w'");
    if(mysql_num_rows($m) == 0)
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