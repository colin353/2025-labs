<?php

$myBalance = myBalance();

?>


<script>
      google.load('visualization', '1.0', {'packages':['corechart']});
	  google.setOnLoadCallback(drawChart);
      
      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      
      <?php 
      
      // First, let's query the appropriate data. Then we'll throw it into the JS.
      
	  $script = "";
	  
	  $f = mysql_query("select * from users order by rand()") or die(mysql_error());

		$total = 0.0001;
		$first = true;
		while($u = mysql_fetch_assoc($f)) {
			if($first) $first = !$first;
			else $script .= ",";
			$z = myBalance($u['user_id']);
			$total += $z;
			$script .= "['".$u['user_name']."',".$z."]";
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
	      var options = {'title':'Shareholders',
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


<h1>Finances</h1>
<p>You control <?php echo format_dollars($myBalance); ?> (<?php echo round(100*$myBalance/$total,2); ?>%) of the company's money.</p>


<div id=investment_pie> </div>