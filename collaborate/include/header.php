<?php include("include/widgets.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>twenty twenty-five</title>
<meta name="author" content="Colin" />
<!-- Date: 2011-09-29 -->

<script src="<?php echo BASE_URL; ?>js/jquery-1.6.2.min.js"></script>
<script src="<?php echo BASE_URL; ?>js/jquery-ui-1.8.16.custom.min.js"></script>
<script src="<?php echo BASE_URL; ?>js/bg_full.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<link rel=stylesheet href="<?php echo BASE_URL; ?>css/ui-lightness/jquery-ui-1.8.16.custom.css" />
			
<link rel=stylesheet href="<?php echo BASE_URL; ?>style/style.css" />
<link rel="shortcut icon" href="/favicon.png" />
<script src="<?php echo BASE_URL; ?>js/functions.js" type=text/javascript></script>
<script type=text/javascript>
	function goto(address) {
		window.location = address;
	}	
	request_q = <?php if(isset($_REQUEST['q'])) echo $_REQUEST['q']; else echo 0; ?>;
	BASE_URL = '<?php echo BASE_URL; ?>';
</script>

</head>

<body>
	
<div id=header> 
<img onClick="goto('/collaborate/')" src="/images/2025.png" />
	
	<ul> 
		<li><a href="<?php echo BASE_URL; ?>projects"><?php echo COLLAB_MENU1;?></a></li>
		<li><a href="<?php echo BASE_URL; ?>finances"><?php echo COLLAB_MENU2;?></a></li>
		<li><a href="<?php echo BASE_URL; ?>people"><?php echo COLLAB_MENU3;?></a></li>
		<li><a href="<?php echo BASE_URL; ?>logout.php"><?php echo COLLAB_MENU_LOGOUT;?></a></li>	
	</ul>

</div>

<div id=content>

