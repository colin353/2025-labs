<?php 


$p = mysql_query('select * from projects where project_id = '.mysql_real_escape_string($_REQUEST['q']));	
	if(mysql_num_rows($p) == 0) nope_chuck_testa();  
	$p = mysql_fetch_assoc($p);

?>

<div id=content>

<h1><?php echo $p['project_name']; ?><span class=sidenote><?php echo $header_sidenote; ?></span></h1>
<p><?php echo $p['project_description']; ?> </p>
<?php


$id = mysql_real_escape_string($_SESSION['user_id']);
$q = mysql_real_escape_string($_REQUEST['q']);
if(mysql_num_rows(mysql_query("select * from projectmemberships where projectmembership_user_id = $id and projectmembership_project_id = $q")) > 0 ) {

$k['overview'] = 'project/'.$_REQUEST['q'];
$k['to-do list'] = 'project-to-do/'.$_REQUEST['q'];
$k['finances'] = 'finance/'.$_REQUEST['q'];
} else {	
	$k['overview'] = 'project/'.$_REQUEST['q'];
$k['finances'] = 'finance/'.$_REQUEST['q'];
}
displayActionMenu($k);
?>
<br />