<?php 

$q = mysql_real_escape_string($_REQUEST['q']);
$header_sidenote = "<a href=# onClick=askToAddProj($q) >+ ".COLLAB_FINANCE_PROJ_NEWFUND."</a>";

include('include/header-project.php');

?>
<br />
<h2>Funding requests:</h2>

<div class=fund_request>
	<p><b></b></p>
	
</div>