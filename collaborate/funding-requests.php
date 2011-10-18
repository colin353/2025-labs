

<?php 

$q = mysql_real_escape_string($_REQUEST['q']);
$header_sidenote = '<a href='.BASE_URL.'income-report/'.$q.'>+ add new income report</a>';

include('include/header-project.php');

?>

<script>
      google.load('visualization', '1.0', {'packages':['corechart']});
	  google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      
      <?php 
      
      // First, let's query the appropriate data. Then we'll throw it into the JS.
      $q = mysql_real_escape_string($_REQUEST['q']);
	  
      $invs = mysql_query($myQuery = " SELECT * , sum( transaction_value ) as t FROM users,accounts as ac_d, accounts as ac_c,transactions WHERE ac_d.account_id = transaction_debtor and ac_c.account_id = transaction_creditor and user_id = ac_c.account_owner_id and ac_d.account_owner_id = $q and ac_d.account_type = 'project' and ac_c.account_type = 'pocket' GROUP BY transaction_creditor      ") or die(mysql_error());
      $invs2 =  mysql_query($myQuery = " SELECT * , sum( transaction_value ) as t FROM accounts as ac_d, accounts as ac_c,transactions WHERE ac_d.account_id = transaction_debtor and ac_c.account_id = transaction_creditor and ac_c.account_owner_id = $q and ac_c.account_type = 'project' and ac_d.account_type = 'pocket' GROUP BY transaction_debtor") or die(mysql_error());

      $invest2 = myQuery("select sum(transaction_value) as t from accounts as ac_d, accounts as ac_c, transactions where transaction_creditor = ac_c.account_id and transaction_debtor = ac_d.account_id and ac_c.account_type = 'shareholder' and ac_d.account_type = 'project' and ac_d.account_owner_id = $q");
     
	  while($i = mysql_fetch_assoc($invs2)) {
	  	$books[''.$i['transaction_debtor']] = $i['t'];
	  	$invest2['t'] += $i['t'];
	  }
    	
    //  echo $myQuery;
      if(isset($invest2['t'])) $script = "['2025',".$invest2['t']."]";
	  else $script = "['2025',0.00001]";
	  
	  $f = true;
	  
	  while($i = mysql_fetch_assoc($invs)) {
	   	if(isset($books[''.$i['transaction_creditor']])) $i['t'] -= $books[''.$i['transaction_creditor']];
		if(round($i['t'],2) != 0) {
			$script .= ",['".$i['user_name']."',".round($i['t'],2)."]";
			$f= false;
		}
	  }
	  
      
      ?>
      
      function drawChart() {

      // Create the data table.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Person');
      data.addColumn('number', 'Contribution');
      data.addRows([ 
        <?php echo $script; ?>
      ]);
      
      var formatter = new google.visualization.NumberFormat({prefix: '$'});
  	  formatter.format(data, 1);

      // Set chart options
      var options = {'title':'Investors',
      				 chartArea: { left:40,top:80,width:380,height:280 },
      				 titleTextStyle : {fontSize: 20},
      				 legendTextStyle: { fontSize: 15},
      				 pieSliceTextStyle: { fontSize: 15 },
      				 tooltipTextStyle: {fontSize: 15},
                     'width':400,
                     'height':300};

      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('investment_pie'));
      chart.draw(data, options);
      
    }

</script>

<br />
<h2>Financial Overview</h2>

<div style="float: right;" id=debt_payback> </div>
<div id=investment_pie> </div>


<br />
<br />

<h2><?php echo COLLAB_FINANCE_PROJ; ?></h2> <?php echo "<a href=".BASE_URL."new-fund-request/$q >+ ".COLLAB_FINANCE_PROJ_NEWFUND."</a>"; ?>

<?php 

$reqs = mysql_query("select * from fundingrequests,accounts where account_owner_id = $q and account_id = fundingrequest_debtor order by fundingrequest_creationdate desc");
$rs = 0; $script = "";
while($r = mysql_fetch_assoc($reqs)) { 

$script .= "rq[".$rs++."] = ".$r['fundingrequest_id'].";\n";

$funds = mysql_query('select * from transactions where transaction_fundingrequest_id='.$r['fundingrequest_id']);
$total_raised = 0;
while($f = mysql_fetch_assoc($funds)) {
	$total_raised += $f['transaction_value'];
}

$perfund = round(100*$total_raised / $r['fundingrequest_value'],4);

if($perfund == 100) {
	$coststr = format_dollars($total_raised);
	$costpref = "Cost: ";
}  
else {
	$coststr = format_dollars($r['fundingrequest_value']-$total_raised) . " / " . format_dollars($r['fundingrequest_value']);
	$costpref = "Still needed: ";
}
?>

<div id=fund_request<?php echo $r['fundingrequest_id']; ?> class="fund_request <?php if($perfund == 100) echo 'fund_request_complete';?>">
	<div class=percent><?php echo round($perfund); ?>% funded</div><p><b><?php echo $costpref; ?></b><span><?php echo $coststr; ?></span>
		<?php if($perfund != 100) { ?>
		<span class=sidenote><a href=<?php echo BASE_URL.'funding-request/'.$r['fundingrequest_id']; ?>> + more info</a></span>
		<?php } ?>	
		</p>
	<p <?php if($perfund == 100) echo 'class=hiding';?>><b>Description: </b></p>
	<p <?php if($perfund == 100) echo 'class=hiding';?>><?php echo $r['fundingrequest_description']; ?></p>
	
</div>

<?php } ?>


<script>
		rq = Array(<?php echo $rs; ?>);
		<?php echo $script; ?>
		
		function dblClickHidingEvent(event) {
				if(event.target.tagName == "DIV") {
					$(event.target).children('p.hiding').toggle('fast');
				} 	
		}
		for(i=0;i<<?php echo $rs; ?>;i++) {
			$("#fund_request"+rq[i]).bind('dblclick',dblClickHidingEvent);			
		}
</script>
