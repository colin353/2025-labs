<?php 

$q = mysql_real_escape_string($_REQUEST['q']);
$header_sidenote = "<a href=# onClick=askToAddProj($q) >+ ".COLLAB_FINANCE_PROJ_NEWFUND."</a>";

include('include/header-project.php');

?>
<br />
<h2><?php echo COLLAB_FINANCE_PROJ; ?></h2>

<?php 

$reqs = mysql_query("select * from fundingrequests where fundingrequest_debtor = $q");

while($r = mysql_fetch_assoc($reqs)) { 

$funds = mysql_query('select * from transactions where transaction_fundingrequest_id='.$r['fundingrequest_id']);
$total_raised = 0;
while($f = mysql_fetch_assoc($funds)) {
	$total_raised += $f['transaction_value'];
}

if($total_raised >= $r['fundingrequest_value']) {
	$coststr = format_dollars($total_raised);
	$costpref = "Cost: ";
}  
else {
	$coststr = format_dollars($r['fundingrequest_value']-$total_raised) . " / " . format_dollars($r['fundingrequest_value']);
	$costpref = "Still needed: ";
}
$perfund = 100*$total_raised / $r['fundingrequest_value'];

?>

<div class="fund_request <?php if($perfund == 100) echo 'fund_request_complete';?>">
	<div class=percent><?php echo round($perfund); ?>% funded</div><p><b><?php echo $costpref; ?></b><span><?php echo $coststr; ?></span></p>
	<p><b>Description: </b></p>
	<p><?php echo $r['fundingrequest_description']; ?></p>
	<!--p><b>Funders:</b> Colin, Matt</p-->
</div>

<?php } ?>
