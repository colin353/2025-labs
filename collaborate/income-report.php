<?php 

$q = mysql_real_escape_string($_REQUEST['q']);
$header_sidenote = '';

include('include/header-project.php');

?>

<br />

<h2>New Income Report</h2>


<form method=post action=<?php echo BASE_URL; ?>action.php class=inputForm>
<p><?php echo COLLAB_NEW_PROJ_INC_DESC; ?></p><textarea name=desc placeholder="<?php echo COLLAB_NEW_PROJ_INC_DESC2; ?>" value=""></textarea>
<p><?php echo COLLAB_NEW_PROJ_INC_VAL; ?></p><input name=val type=text placeholder="<?php echo COLLAB_NEW_PROJ_INC_VAL2; ?>" class=big value="" /></p>
<input type=hidden name=income_report value=true />
<input type=hidden name=q value=<?php echo $q; ?> />
<input type=hidden name=project_unique value=<?php echo rand().rand(); ?> />
<input type=submit value="Report Income"/>
</form>