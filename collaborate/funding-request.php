<?php

$q = mysql_real_escape_string($_REQUEST['q']);
$header_sidenote = '';

$r = mysql_fetch_assoc(mysql_query($royco = "select * from fundingrequests,accounts where fundingrequest_debtor = account_id and account_type = 'project' and fundingrequest_id = $q"));
//echo $royco;
$q = $r['account_owner_id'];
$_REQUEST['q'] = $q;

$funds = mysql_query('select * from transactions where transaction_fundingrequest_id='.$r['fundingrequest_id']);
$total_raised = 0;
while($f = mysql_fetch_assoc($funds)) {
	$total_raised += $f['transaction_value'];
}
$perfund = 100*$total_raised / $r['fundingrequest_value'];
$costfrac = format_dollars($r['fundingrequest_value']-$total_raised) . " / " . format_dollars($r['fundingrequest_value']);
include('include/header-project.php');

$costrosity = $r['fundingrequest_value']-$total_raised;

?>
<br />
<h2>Progress:</h2>

<div><p><span>Still required: <?php echo $costfrac; ?>; <?php echo COLLAB_PCTC1." ".round($perfund)."% ".COLLAB_PCTC2; ?></span><br />
<div id=progressbar> </div></p></div>

<script>
		var fund_amount = 0;

	    $(document).ready(function() {
  		  $("#progressbar").progressbar({ step: 5, value: <?php echo $perfund; ?> });
  		   
		 	$( "#slider" ).slider({ disabled: false, 
   				slide: function(event, ui) { 
   					fund_amount = ui.value*<?php echo $costrosity; ?>;
   					$('#slind').html('$ '+Math.round(fund_amount)/100);
   			}
   			
   			});
		 	
		 	
  		});
  		
  		function fundProject() {
  				fundRequest(<?php echo $r['fundingrequest_id']; ?>,fund_amount/100,securityCode);
  		}
  		
  		securityCode = "<?php echo md5(rand().time()); ?>";
  		
</script>


<h2>Description:</h2>
<div>
<p><?php echo $r['fundingrequest_description']; ?></p></div>
<br />
<h2>Fund this project:</h2>
<div><p>Your shareholder balance is: <?php echo format_dollars(myBalance()); ?> </p></div>
<div style="width: 600px;">
<div style="float: right;"><p id=slind>$ 0.00</p></div>
<div><p>How much do you want to contribute?</p><div style="width: 400px; height: 20px;" id=slider></div>
<br /><input onClick=fundProject() type=button value="Fund" />
</div>